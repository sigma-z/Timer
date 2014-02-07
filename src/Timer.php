<?php
/*
 * This file is part of the SigmaZ\Timer package.
 * (c) Steffen Zeidler <sigma_z@sigma-scripts.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SigmaZ;

/**
 * Class Timer
 *
 * @author  Steffen Zeidler <sigma_z@sigma-scripts.de>
 * @date    07.07.2014
 */
class Timer
{

    /** @var float[] */
    private static $startTimers = array();

    /** @var float[] */
    private static $elapsedTimes = array();


    /**
     * @param  string $name
     * @throws TimerException
     */
    public static function start($name = null)
    {
        if ($name === null) {
            $name = '_default_';
        }
        if (isset(self::$startTimers[$name])) {
            throw new TimerException("Timer '$name' was not stopped! Can not start timer twice!");
        }
        self::$startTimers[$name] = microtime(true);
        if (!isset(self::$elapsedTimes[$name])) {
            self::$elapsedTimes[$name] = .0;
        }
    }


    /**
     * @param  string $name
     * @return float
     * @throws TimerException
     */
    public static function stop($name = null)
    {
        if ($name === null) {
            $name = '_default_';
        }
        if (!isset(self::$startTimers[$name])) {
            throw new TimerException("Can not stop time, because timer '$name' was not started!");
        }
        $elapsed = microtime(true) - self::$startTimers[$name];
        self::$elapsedTimes[$name] += $elapsed;
        unset(self::$startTimers[$name]);
        return $elapsed;
    }


    /**
     * @param  string $name
     * @return float
     * @throws TimerException
     */
    public static function getElapsedTime($name = null)
    {
        if ($name === null) {
            $name = '_default_';
        }
        if (!isset(self::$elapsedTimes[$name])) {
            throw new TimerException("No stopped timer for '$name' found!");
        }
        return self::$elapsedTimes[$name];
    }


    /**
     * @return \float[]
     */
    public static function getElapsedTimes()
    {
        return self::$elapsedTimes;
    }


    public static function reset()
    {
        self::$startTimers = array();
        self::$elapsedTimes = array();
    }

}
