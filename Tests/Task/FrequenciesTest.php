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

use Cron\CronExpression;
use MIT\Bundle\SchedulerBundle\Task\Task;
use PHPUnit\Framework\TestCase;

class FrequenciesTest extends TestCase
{
    /**
     * @var Task
     */
    protected $task;

    public function setUp()
    {
        parent::setUp();

        $this->task = new TestTask('ls -al');
    }

    /**
     * @param $expression
     *
     * @dataProvider getExpressions
     */
    public function testCron($expression)
    {
        $this->assertTrue($this->task->cron($expression) instanceof Task);

        $this->assertSame($expression, $this->task->getExpression());

        $this->assertSame('ls -al', $this->task->getCommand());
    }

    public function testHourly()
    {
        $this->task->hourly();

        $this->assertSame('@hourly', $this->task->getExpression());
    }

    public function testDaily()
    {
        $this->task->daily();

        $this->assertSame('@daily', $this->task->getExpression());
    }

    public function testMonthly()
    {
        $this->task->monthly();

        $this->assertSame('@monthly', $this->task->getExpression());
    }

    public function getExpressions()
    {
        return [
            ['0 * * 2 * *'],
            ['0 * * */5 * *']
        ];
    }
}
