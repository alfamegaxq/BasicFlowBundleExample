symfony3_flow
=============

This is bundle designed to controll flow of actions.

#Useful for

- validating pages flow
- saving pages states
- writing interceptors

#Setup

###config

config.yml

`
basic_flow:
     steps:
         - 'step1'
         - 'step2'
         - 'step3'
     retain_data_keys:
         - 'step1'
         - 'step2'
         - 'step3'
`

steps are route names. Order matters.

###define your interceptors
services.yml:

`

    basic_flow.intrceptor.step1:
        class: 'BasicFlowBundle\Service\FlowInterceptor\Step1Interceptor'
        arguments: ["@basic_flow.retainer.session"]
        tags:
            - { name: basic_flow.interceptor_service }

    basic_flow.intrceptor.step2:
        class: 'BasicFlowBundle\Service\FlowInterceptor\Step2Interceptor'
        arguments: ["@basic_flow.retainer.session"]
        tags:
            - { name: basic_flow.interceptor_service }

    basic_flow.intrceptor.step3:
        class: 'BasicFlowBundle\Service\FlowInterceptor\Step3Interceptor'
        arguments: ["@basic_flow.retainer.session"]
        tags:
            - { name: basic_flow.interceptor_service }
`

###Interceptor example

`<?php
namespace BasicFlowBundle\Service\FlowInterceptor;

use BasicFlowBundle\Retainer\RetainerInterface;
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
        throw new AccessDeniedException();
    }
    public function onPath()
    {
        return 'step1';
    }
}`

###Define your custom data retainer

Aready defined retainers:
- basic_flow.retainer.cookie
- basic_flow.retainer.session

services.yml

`basic_flow.retainer.session:
        class: 'BasicFlowBundle\Retainer\SessionRetainer'
        calls:
            - [setSession, ["@session"]]`
            
###Define extension

services.yml

`
    basic_flow.twig_extension.flow:
            class: 'BasicFlowBundle\Twig\BasicFlowExtension'
            public: false
            calls:
                - [setContainer, ["@service_container"]]
                - [setRetainer, ["@basic_flow.retainer.session"]]
            tags:
                - { name: twig.extension, priority: 255 }

`

setRetainer method sets your custom or already defined retainer

