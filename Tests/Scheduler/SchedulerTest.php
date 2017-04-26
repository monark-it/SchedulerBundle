<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Tests\Scheduler;

use MIT\Bundle\SchedulerBundle\Scheduler\Scheduler;
use MIT\Bundle\SchedulerBundle\Task\Task;

class SchedulerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
    
    public function testTaks()
    {
        $scheduler = new FakeScheduler();
        
        $this->assertSame(0, count($scheduler->tasks()));
    }

    public function testDueTasks()
    {
        $scheduler = new FakeScheduler();

        $this->assertSame([], $scheduler->dueTasks());
        $this->assertSame([], $scheduler->tasks());

        $scheduler->task(new Task('ls -al',  '* * * * * *'));

        $scheduler->task(new Task('ls -al',  '* * * * * 2300'));

        $this->assertSame(2, count($scheduler->tasks()));
        $this->assertSame(1, count($scheduler->dueTasks()));
    }

    public function testClear()
    {
        $scheduler = new FakeScheduler();

        $this->assertSame([], $scheduler->dueTasks());
        $this->assertSame([], $scheduler->tasks());

        $scheduler->bulk([
            new Task('ls -al',  '* * * * * *'),
            new Task('ls -al',  '* * * * * 2300'), // Not Due
            new Task('ls -al',  '* * * * * *'),
            new Task('ls -al',  '* * * * * *'),
            new Task('ls -al',  '* * * * * *')
        ]);

        $this->assertSame(5, count($scheduler->tasks()));
        $this->assertSame(4, count($scheduler->dueTasks()));

        $scheduler->clear();

        $this->assertSame([], $scheduler->dueTasks());
        $this->assertSame([], $scheduler->tasks());
    }

    public function testRemove()
    {
        $scheduler = new FakeScheduler();

        $scheduler->task($task = new Task('ls -al',  '* * * * * *'));

        $this->assertSame(1, count($scheduler->tasks()));

        $this->assertInstanceOf(Scheduler::class, $scheduler->remove($task));

        $this->assertSame(0, count($scheduler->tasks()));
    }
}

class FakeScheduler extends Scheduler
{
}