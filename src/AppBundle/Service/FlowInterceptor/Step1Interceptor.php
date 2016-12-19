<?php

namespace AppBundle\Service\FlowInterceptor;

use BasicFlowBundle\Retainer\RetainerInterface;
use BasicFlowBundle\Service\FlowInterceptor\AbstractFlowInterceptor;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Step1Interceptor extends AbstractFlowInterceptor
{

    private $retainer;

    public function __construct(RetainerInterface $retainer)
    {
        $this->retainer = $retainer;
    }

    public function needInterception()
    {
        return false;
    }

    public function interceptAction()
    {
        //throw new AccessDeniedException();
    }

    public function onPath()
    {
        return 'step1';
    }
}