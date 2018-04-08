<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 08/04/18
 * Time: 16:58
 */

namespace MIT\SchedulerBundle\Tests\Utils;


use MIT\Bundle\SchedulerBundle\Utils\System;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    public function testOs()
    {
        $this->assertEquals(PHP_OS, System::os());
    }
}
