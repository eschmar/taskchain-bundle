<?php

namespace Eschmar\TaskChainBundle\Task;

/**
 * TaskAbstract is extended by all tasks to be executed by cronjob
 *
 * @author Marcel Eschmann
 **/
abstract class TaskAbstract
{

	/**
	 * Task name for console output
	 *
	 * @var string
	 **/
	protected $name = 'UnknownTask';

	/**
	 * Defines when this task should be executed by the taskChain
	 *
	 * @var array(string)
	 **/
	protected $groups = array();


	function __construct() {
		$this->init();
	}


	/**
	 * Initialises the task by defining name and groups
	 *
	 * @return void
	 * @author Marcel Eschmann
	 **/
	abstract protected function init();


	/**
	 * Task logic
	 *
	 * @return boolean
	 * @author Marcel Eschmann
	 **/
	abstract public function execute();


	/**
	 * Returns the name of the task
	 *
	 * @return string
	 * @author Marcel Eschmann
	 **/
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Returns the group array of the task
	 *
	 * @return array(string)
	 * @author Marcel Eschmann
	 **/
	public function getGroups()
	{
		return $this->groups;
	}

} // END abstract class TaskAbstract