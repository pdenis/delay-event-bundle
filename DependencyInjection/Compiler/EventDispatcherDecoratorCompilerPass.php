<?php

namespace Itkg\DelayEventBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * class EventDispatcherDecoratorCompilerPass 
 */
class EventDispatcherDecoratorCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('event_dispatcher');
        $definition->setPublic(false);
        $container->setDefinition('itkg_delay_event.event_dispatcher.parent', $definition);
        $container->setAlias('event_dispatcher', 'itkg_delay_event.event_dispatcher');
    }
}
