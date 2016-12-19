<?php

namespace AppBundle\Service\FlowInterceptor;

use BasicFlowBundle\Retainer\RetainerInterface;
use BasicFlowBundle\Service\FlowInterceptor\AbstractFlowInterceptor;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class Step2Interceptor extends AbstractFlowInterceptor
{

    /**
     * @var RetainerInterface
     */
    private $retainer;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RetainerInterface $retainer, RouterInterface $router)
    {
        $this->retainer = $retainer;
        $this->router = $router;
    }

    public function needInterception()
    {
        return $this->retainer->getData('step1') === NULL;
    }

    public function interceptAction()
    {
        if ($this->retainer->getData('step1') === NULL) {
            $this->redirect('step1');
        }
    }

    public function onPath()
    {
        return 'step2';
    }

    private function redirect($path)
    {
        $url = $this->router->generate($path);
        $this->event->setController(function () use ($url) {
            return new RedirectResponse($url);
        });
    }
}