<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Command;

use MIT\Bundle\SchedulerBundle\Scheduler\SchedulerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MitSchedulerRunCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('mit:scheduler:run')
            ->setDescription('Run the scheduler command.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln((new \DateTime())->format(DATE_RFC850).' : Running scheduled tasks');
        $counter=0;
        foreach ($this->scheduler()->dueTasks() as $task){
            // Application is injected in the task so the task can have access to other Symfony commands, services...
            $task->run($this->getApplication());
            $counter++;
        }
        $output->writeln((new \DateTime())->format(DATE_RFC850).' : Running scheduled tasks finished. '.$counter.' tasks have been executed.');
    }

    /**
     * Get the scheduler.
     *
     * @return SchedulerInterface
     */
    protected function scheduler()
    {
        return $this->getApplication()->getScheduler();
    }
}
