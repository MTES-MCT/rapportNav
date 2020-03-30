<?php

namespace App\Tests\Helper;

use App\Helper\TimeConvert;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * Class TimeConvertTest
 *
 * @covers \App\Helper\TimeConvert
 */
class TimeConvertTest extends TestCase {

    public function testMinutesToTime() {
        $this->assertSame(null, TimeConvert::minutesToTime(null));

        $this->assertSame(
            (new \DateTime("2:13"))->format("H:i"),
            (TimeConvert::minutesToTime(133))->format("H:i")
        );

        //Implicit cast of float to int
        $this->assertSame("03:03", (TimeConvert::minutesToTime(183.8))->format('H:i'));
    }
}
