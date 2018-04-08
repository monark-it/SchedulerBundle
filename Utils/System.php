<?php

/*
 * This file is part of the MIT Platform Project.
 *
 * (c) Multi Information Technology <http://www.mit.co.ma>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MIT\Bundle\SchedulerBundle\Utils;

final class System
{
    private function __construct(){}

    /**
     * Guess Operating System.
     *
     * @return string
     */
    public static function os()
    {
        return PHP_OS;
    }

    /**
     * Title tells all.
     *
     * @return bool
     */
    public static function isWindowsOS()
    {
        return in_array(strtoupper(self::os()), ['WINNT', 'WINDOWS', 'WIN32', 'WINDOWS_NT'], true);
    }

    /**
     * Title tells all.
     *
     * @return bool
     */
    public static function isUnixOS()
    {
        return in_array(strtoupper(self::os()), ['LINUX', 'UNIX', 'FREEBSD'], true);
    }
}