<?php

namespace Eschmar\TaskChainBundle\Task;

/**
 * Test Task
 *
 * @package default
 * @author Marcel Eschmann
 **/
class TestTask extends TaskAbstract
{
	/**
	 * {@inheritdoc }
	 *
	 * @author Marcel Eschmann
	 **/
	protected function init() {
		$this->name = 'Test Task';
		$this->groups[] = 'test';
	}


	/**
	 * {@inheritdoc }
	 *
	 * @author Marcel Eschmann
	 **/
	public function execute() {
		sleep(3);
		return true;
	}

} // END class TestTask extends TaskAbstract

