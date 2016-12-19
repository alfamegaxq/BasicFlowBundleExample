<?php

namespace BasicFlowBundle;

use BasicFlowBundle\DependencyInjection\Compiler\FlowListenerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BasicFlowBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FlowListenerPass());
    }

}
