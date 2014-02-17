<?php

namespace Eschmar\TaskChainBundle\Service;

use Eschmar\TaskChainBundle\Task\TaskAbstract;

/**
 * Collects all tasks to be executed by cronjob.
 *
 * @author Marcel Eschmann
 **/
class TaskChain
{

	/**
	 * Contains references to all tasks
	 *
	 * @var array(TaskAbstract)
	 **/
	private $chain;


	function __construct() {
		$this->chain = array();
	}


	/**
	 * Adds a task reference to the chain
	 *
	 * @return void
	 * @author Marcel Eschmann
	 **/
	public function addTask(TaskAbstract $task)
	{
		$this->chain[] = $task;
	}


	/**
	 * Removes references to tasks (not) containing the group `$group`
	 *
	 * @return void
	 * @author Marcel Eschmann
	 **/
	public function filter($group, $inset = false)
	{
		if ($inset) {
			foreach ($this->chain as $key => $task) {
				if (in_array($group, $task->getGroups())) {
					unset($this->chain[$key]);
				}
			}
			return;
		}

		foreach ($this->chain as $key => $task) {

			if (!in_array($group, $task->getGroups())) {
				unset($this->chain[$key]);
			}
		}
	}


	/**
	 * Returns the chain
	 *
	 * @return array(TaskAbstract)
	 * @author Marcel Eschmann
	 **/
	public function getChain()
	{
		return $this->chain;
	}

} // END class TaskChain