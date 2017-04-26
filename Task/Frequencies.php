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

trait Frequencies
{
    public function cron($expression)
    {
        $this->expression = $expression;
        
        return $this;
    }

    public function daily()
    {
        return $this->cron("@daily");
    }

    public function monthly()
    {
        return $this->cron("@monthly");
    }

    public function hourly()
    {
        return $this->cron("@hourly");
    }

    protected function changePosition($key, $value)
    {
        $segments = explode(' ', $this->expression);
        $segments[$key - 1] = $value;
        
        return $this->cron(implode(' ', $segments));
    }
}