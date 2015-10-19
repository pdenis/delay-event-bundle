<?php

namespace Itkg\DelayEventBundle;

use Itkg\DelayEventBundle\DependencyInjection\Compiler\EventDispatcherDecoratorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * class ItkgDelayEventBundle 
 */
class ItkgDelayEventBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new EventDispatcherDecoratorCompilerPass());
    }
}
