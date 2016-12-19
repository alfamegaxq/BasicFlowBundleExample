<?php

namespace BasicFlowBundle\EventListener;

use BasicFlowBundle\Controller\StepInterface;
use BasicFlowBundle\Service\FlowInterceptor\AbstractFlowInterceptor;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class FlowListener
{
    /** @var  ContainerInterface */
    private $container;

    /**
     * @var RequestStack
     */
    private $request;

    /** @var  array */
    private $interceptorContainer;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        if ($this->container->has('request_stack')) {
            $this->request = $this->container->get('request_stack');
        }
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        $currentRouteName = $this->request->getCurrentRequest()->get('_route');
        if ($controller[0] instanceof StepInterface) {
            foreach ($this->interceptorContainer as $interceptor) {
                $interceptor->setEvent($event);
                if (
                    ($interceptor->onPath() && $interceptor->onPath() === $currentRouteName && $interceptor->needInterception()) ||
                    (!$interceptor->onPath() && $interceptor->needInterception())
                ) {
                    $interceptor->interceptAction();
                }
            }
        }
    }

    /**
     * @param AbstractFlowInterceptor $interceptor
     */
    public function addInterceptor($interceptor)
    {
        $this->interceptorContainer[] = $interceptor;
    }
}