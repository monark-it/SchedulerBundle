<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Scheduler;

use MIT\Bundle\SchedulerBundle\Task\Task;

class Scheduler implements SchedulerInterface
{
    /**
     * @var array
     */
    protected $tasks = [];

    /**
     * This method has no sense unless you store your schedule in a database.
     *
     * @return $this
     */
    public function clear()
    {
        $this->tasks = [];
        
        return $this;
    }

    /**
     * @param Task $task
     * @return $this
     */
    public function remove(Task $task)
    {
        $this->tasks = array_filter($this->tasks, function(Task $item) use($task){
            return md5($task->getExpression().$task->getCommand()) !== md5($item->getExpression().$item->getCommand());
        });
         return $this;
    }

    public function tasks()
    {
        return $this->tasks;
    }

    /**
     * @param string|\DateTime $currentTime
     * @return array
     */
    public function dueTasks($currentTime = 'now')
    {
        return array_filter($this->tasks(), function(Task $task) use ($currentTime){
            return $task->isDue($currentTime);
        });
    }

    public function task($task)
    {
        $this->tasks = is_array($task) ? array_merge($this->tasks, $task) : array_merge($this->tasks, [$task]);
        return $task;
    }

    public function bulk(array $tasks)
    {
        $this->tasks = array_merge($this->tasks, $tasks);
        return $this;
    }
}
