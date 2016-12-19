<?php
/**
 * Created by PhpStorm.
 * User: gkatilevicius
 * Date: 16.12.17
 * Time: 11.55
 */

namespace BasicFlowBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('basic_flow');

        $rootNode
            ->children()
                ->arrayNode('steps')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('retain_data_keys')
                    ->prototype('scalar')->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}