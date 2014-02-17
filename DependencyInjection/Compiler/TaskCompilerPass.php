<?php

namespace Eschmar\TaskChainBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TaskCompilerPass implements CompilerPassInterface
{

    /**
     * Adds all tagged services to the TaskChain.
     *
     * @return void
     * @author Marcel Eschmann
     **/
    public function process(ContainerBuilder $container)
    {
        // Check for existence of the TaskChain
        if (!$container->hasDefinition('eschmar_taskchain')) {
            return;
        }

        // Look for all services tagged
        $definition = $container->getDefinition(
            'eschmar_taskchain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'taskchain'
        );

        // add a call to addTask() for each task to the definition
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addTask',
                array(new Reference($id))
            );
        }
    }
}