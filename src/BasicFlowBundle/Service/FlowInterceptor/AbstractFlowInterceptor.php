<?php

namespace BasicFlowBundle\Service\FlowInterceptor;


use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

abstract class AbstractFlowInterceptor
{
    /** @var  FilterControllerEvent */
    protected $event;

    public function setEvent(FilterControllerEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Return string of path if you want to enable interceptor on defined path
     *
     * @return bool
     */
    public function onPath() {
        return false;
    }

    /**
     * Write your condition when interceptor should intercept
     *
     * @return bool
     */
    abstract public function needInterception();

    /**
     * Write your actions when interceptors needs to initiate its interception
     *
     * @return mixed
     */
    abstract public function interceptAction();
}