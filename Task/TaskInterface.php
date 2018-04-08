<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 08/04/18
 * Time: 18:05
 */

namespace MIT\Bundle\SchedulerBundle\Task;


use Symfony\Bundle\FrameworkBundle\Console\Application;

interface TaskInterface
{
    public function run($app);
}