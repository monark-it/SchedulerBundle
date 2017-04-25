<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Tests\Task;

use MIT\Bundle\SchedulerBundle\Console\ConsoleApplication;
use MIT\Bundle\SchedulerBundle\Task\Task;
use MIT\Bundle\SchedulerBundle\Utils\System;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskTest extends WebTestCase
{
    /**
     * @var Task
     */
    protected $task;

    protected function setUp()
    {
        parent::setUp();
        self::bootKernel();
        $this->task = new TestTask('ls -al');
    }

    public function testGetOutput()
    {
        $task = new TestTask('ls -al');

        $this->assertSame('* * * * * *', $task->getExpression());
        $this->assertSame('ls -al', $task->getCommand());

        $this->assertTrue(System::isWindowsOS() ? ($task->getOutput() === 'NUL') : ($task->getOutput() === '/dev/null'));
    }

    public function testBuildCommand()
    {
        $this->task->buildCommand();

        if(System::isUnixOS()){
            $this->assertSame('ls -al >> /dev/null', $this->task->buildCommand());
        }
        if(System::isWindowsOS()){
            $this->assertSame('ls -al >> NUL', $this->task->buildCommand());
        }
    }

    /**
     * @param $cmd
     * @param $expectedOutput
     * @dataProvider cmdFixtures
     */
    public function testRun($cmd, $expectedOutput)
    {
    }

    public function cmdFixtures()
    {
        return [
            ['foo:bar', 'foo:bar: command not found']
        ];
    }

    protected function getConsole()
    {
        return new ConsoleApplication(self::$kernel);
    }
}

class TestTask extends Task
{
}
