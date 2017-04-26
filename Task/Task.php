<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Task;

use Cron\CronExpression;
use MIT\Bundle\SchedulerBundle\Utils\System;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Process\Process;

class Task
{
    use Frequencies;
    
    protected $command;

    protected $expression;

    protected $description = '';

    protected $output;

    protected $beforeCallbacks = [];

    protected $afterCallbacks = [];

    protected $cwd;

    public function __construct($command, $expression = '* * * * * *')
    {
        $this->expression = $expression;
        $this->command = $command;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output = (System::isWindowsOS() ? 'NUL' : '/dev/null');
    }

    /**
     * @param mixed $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * @param Application $app
     * @return string
     */
    public function run($app)
    {
        $this->before();

        if ($app instanceof Application){
            $this->cwd = realpath($app->getKernel()->getRootDir().'/../');
        }
        $process = new Process($this->buildCommand(), $this->cwd());
        $process->run();

        $this->after();
        return $process->getOutput();
    }
    
    public function getCommand()
    {
        return $this->command;
    }
    
    
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
    }

    public function isDue($currentTime = 'now')
    {
        return ((!$this->skip()) && CronExpression::factory($this->expression)->isDue($currentTime));
    }

    /**
     * Returns true if this task should be skipped.
     *
     * @return bool
     */
    final public function skip()
    {
        return false;
    }

    /**
     * Called before task start running.
     */
    public function before()
    {
        return $this;
    }

    /**
     * Called after task finished running.
     */
    public function after()
    {
        return $this;
    }

    /**
     * Returns current working directory for this task.
     *
     * @return string
     */
    public function cwd()
    {
        return $this->cwd;
    }

    public function buildCommand()
    {
        return $this->command. ' >> '.$this->getOutput();
    }
}
