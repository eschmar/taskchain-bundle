<?php

namespace Eschmar\TaskChainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class CronCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('taskchain')
            ->setDescription('Invoke taskchain containing all tasks to be executed by cronjob.')
            ->addArgument('group', InputArgument::OPTIONAL, 'Which tasks should be executed (default == all)?')
            ->addOption('inset', null, InputOption::VALUE_NONE, 'If set, all tasks will be executed except for the ones in the chosen group')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	// define red color for output
    	$style = new OutputFormatterStyle('red');
		$output->getFormatter()->setStyle('red', $style);

		// head
    	//$output->writeln('');
    	$output->writeln('<red>');
		$output->writeln('   ______           __      ________          _      ');
        $output->writeln('  /_  __/___ ______/ /__   / ____/ /_  ____ _(_)___  ');
        $output->writeln('   / / / __ `/ ___/ //_/  / /   / __ \/ __ `/ / __ \ ');
        $output->writeln('  / / / /_/ (__  ) ,<    / /___/ / / / /_/ / / / / / ');
        $output->writeln(' /_/  \__,_/____/_/|_|   \____/_/ /_/\__,_/_/_/ /_/  ');
		$output->writeln('</red>');
        $output->writeln(' --------------------------- START ---------------------------  ');
        $output->writeln('');

    	// get the taskChain
    	$taskChain = $this->getContainer()->get('eschmar_taskchain');

    	// filter taskChain by argument `group`
    	$filter = $input->getArgument('group');
    	$inset = $input->getOption('inset');
    	
    	if ($filter) {
    		$taskChain->filter($filter, $inset ? true : false);
    	}

    	$executed = false;

    	// execute every task still in the taskChain and output outcome
    	foreach ($taskChain->getChain() as $task) {
    		$executed = true;
    		$output->write(' . '.$task->getName().'... ');

            if ($task->execute()) {
                $output->writeln('<comment>success</comment>');
            }else {
                $output->writeln('<red>failed</red>');
            }
    	}

    	// check if no task was executed
    	if (!$executed) {
    		$output->writeln('<red> No matching tasks found...</red>');
    	}

    	// footer
    	$output->writeln('');
    	$output->writeln(' ---------------------------- END ----------------------------  ');
    	$output->writeln('');
    }
}


