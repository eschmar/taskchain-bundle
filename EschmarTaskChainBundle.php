<?php

namespace Eschmar\TaskChainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Eschmar\TaskChainBundle\DependencyInjection\Compiler\TaskCompilerPass;

class EschmarTaskChainBundle extends Bundle
{
	/**
	 * Register the TaskCompilerPass.
	 *
	 * @return void
	 * @author Marcel Eschmann
	 **/
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$container->addCompilerPass(new TaskCompilerPass());
	}
}