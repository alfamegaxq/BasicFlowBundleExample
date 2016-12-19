<?php

namespace BasicFlowBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FlowListenerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has('basic_flow.step.action_listener')) {
            return;
        }

        $definition = $container->findDefinition('basic_flow.step.action_listener');

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('basic_flow.interceptor_service');

        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the ChainTransport service
            $definition->addMethodCall('addInterceptor', array(new Reference($id)));
        }
    }

}