<?php
/*
 * This file is part of the SigmaZ\Timer package.
 * (c) Steffen Zeidler <sigma_z@sigma-scripts.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/../src/Timer.php';

use SigmaZ\Timer;

/**
 * Class TimerTest
 *
 * @author  Steffen Zeidler <sigma_z@sigma-scripts.de>
 * @date    07.02.2014
 */
class TimerTest extends \PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Timer::reset();
    }


    public function testStopTime()
    {
        $this->givenTimerStarted();
        $elapsed = $this->whenStoppingTimer();
        $this->thenExpectTimeToBeElapsed($elapsed);
    }


    public function testStopTimeForWithName()
    {
        $this->givenTimerStarted('total');

        $this->givenTimerStarted('a');
        usleep(2000);
        $this->whenStoppingTimer('a');

        $this->givenTimerStarted('b');
        usleep(1000);
        $this->whenStoppingTimer('b');

        $this->givenTimerStarted('b');
        usleep(1000);
        $this->whenStoppingTimer('b');

        $this->givenTimerStarted('a');
        usleep(2000);
        $this->whenStoppingTimer('a');

        $this->whenStoppingTimer('total');

        $totalTimeElapsed = Timer::getElapsedTime('total');
        $timeElapsedForA = Timer::getElapsedTime('a');
        $timeElapsedForB = Timer::getElapsedTime('b');
        $this->assertEquals($totalTimeElapsed, $timeElapsedForA + $timeElapsedForB, '', $totalTimeElapsed * .2);
    }


    /**
     * @param string $name
     */
    private function givenTimerStarted($name = null)
    {
        Timer::start($name);
    }


    /**
     * @param  string $name
     * @return float
     */
    private function whenStoppingTimer($name = null)
    {
        return Timer::stop($name);
    }


    /**
     * @param float $elapsedMilliSeconds
     */
    private function thenExpectTimeToBeElapsed($elapsedMilliSeconds)
    {
        $this->assertTrue($elapsedMilliSeconds > 0);
    }

}
