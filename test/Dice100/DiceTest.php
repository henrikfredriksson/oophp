<?php

namespace Hfn\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{

    public function testDiceWithNoArgument()
    {
        $dice = new Dice();
        $res = $dice->getValue();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    public function testDiceLowerValue()
    {
        $dice = new Dice();

        $dice->roll();
        $res = $dice->getValue();

        $exp = 1;
        $this->assertGreaterThanOrEqual($exp, $res);
    }

    public function testDiceUpperValue()
    {
        $dice = new Dice();

        $dice->roll();
        $res = $dice->getValue();
        $exp = 6;
        $this->assertLessThanOrEqual($exp, $res);
    }
}
