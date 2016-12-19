<?php

namespace AppBundle\Service\FlowInterceptor;

use BasicFlowBundle\Retainer\RetainerInterface;
use BasicFlowBundle\Service\FlowInterceptor\AbstractFlowInterceptor;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class Step3Interceptor extends AbstractFlowInterceptor
{

    /**
     * @var RetainerInterface
     */
    private $retainer;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * Step3Interceptor constructor.
     * @param RetainerInterface $retainer
     * @param RouterInterface $router
     */
    public function __construct(RetainerInterface $retainer, RouterInterface $router)
    {
        $this->retainer = $retainer;
        $this->router = $router;
    }

    public function needInterception()
    {
        return $this->retainer->getData('step1') === NULL || $this->retainer->getData('step2') === NULL;
    }

    public function interceptAction()
    {
        if ($this->retainer->getData('step1') === NULL) {
            $this->redirect('step1');
        } elseif ($this->retainer->getData('step2') === NULL) {
            $this->redirect('step2');
        }
    }

    public function onPath()
    {
        return 'step3';
    }

    private function redirect($path)
    {
        $url = $this->router->generate($path);
        $this->event->setController(function () use ($url) {
            return new RedirectResponse($url);
        });
    }
}