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

interface SchedulerInterface
{
    /**
     * Get all tasks in the schedule.
     *
     * @return array
     */
    public function tasks();

    /**
     * All due tasks in the schedule.
     *
     * @return array
     */
    public function dueTasks();

    /**
     * Clear the schedule.
     *
     * @return mixed
     */
    public function clear();

    /**
     * Put a new task into the schedule.
     *
     * @param Task $task
     * @return Task
     */
    public function task($task);

    /**
     * Post an array of tasks in the schedule.
     *
     * @param array $tasks
     * @return SchedulerInterface
     */
    public function bulk(array $tasks);
}
