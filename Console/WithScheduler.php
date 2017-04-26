<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Console;

use MIT\Bundle\SchedulerBundle\Scheduler\SchedulerInterface;

trait WithScheduler
{
    /**
     * @var SchedulerInterface
     */
    protected $scheduler;

    /**
     * @return SchedulerInterface
     */
    public function getScheduler()
    {
        $this->scheduler = $this->getKernel()->getContainer()->get('mit_scheduler.scheduler');
        $this->initSchedule();
        return $this->scheduler;
    }

    public function initSchedule()
    {
    }
}