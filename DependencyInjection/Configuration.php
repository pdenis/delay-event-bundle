<?php

namespace Itkg\DelayEventBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('itkg_delay_event');
        $rootNode->children()
            ->arrayNode('processor')
                ->children()
                    ->arrayNode('retry_count')
                        ->children()
                            ->scalarNode('normal')->defaultValue(1)->end()
                            ->scalarNode('critic')->defaultValue(1)->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ->arrayNode('events')
                ->prototype('array')
                    ->children()
                        ->scalarNode('type')
                            ->validate()
                                ->ifTrue(function($v){ return !in_array($v, array('normal', 'critic')); })
                                ->thenInvalid('%s is not a valid type')
                            ->end()
                            ->defaultValue('normal')
                        ->end()
                    ->end()
            ->end();

        return $treeBuilder;
    }
}
