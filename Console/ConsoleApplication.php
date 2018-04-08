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

use MIT\Bundle\SchedulerBundle\Task\Task;
use Symfony\Bundle\FrameworkBundle\Console\Application;

class ConsoleApplication extends Application
{
    use WithScheduler;

    public function initSchedule()
    {
        return $this->scheduler->bulk([
            // new \AppBundle\Task\SendMail(),
            // new Task("ls -al", "@hourly"),
            // new Task("ls -al", "*/5 * * * * * ")
        ]);
    }
}