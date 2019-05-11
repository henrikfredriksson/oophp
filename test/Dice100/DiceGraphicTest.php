<?php

namespace Hfn\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * A dice with no arguments should have
     * default value 1
     *
     * @return void
     */
    public function testDiceGraphicWithNoArgument()
    {
        $dice = new DiceGraphic();
        $res = $dice->getValue();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * A dice should have value geq than 1
     *
     * @return void
     */
    public function testDiceGraphicLowerValue()
    {
        $dice = new DiceGraphic();

        $dice->roll();
        $res = $dice->getValue();

        $exp = 1;
        $this->assertGreaterThanOrEqual($exp, $res);
    }

    /**
     * A dice should have value leq than 6
     *
     * @return void
     */
    public function testDiceGraphicUpperValue()
    {
        $dice = new DiceGraphic();

        $dice->roll();
        $res = $dice->getValue();
        $exp = 6;
        $this->assertLessThanOrEqual($exp, $res);
    }

    /**
     * The graphics of DiceGraphic with value x
     * should return with "dice-x"
     *
     * @return void
     */
    public function testDiceGraphicContainDice()
    {
        $dice = new DiceGraphic(1);

        $res = $dice->graphic();
        $exp = "dice-1";
        $this->assertEquals($exp, $res);

        $dice = new DiceGraphic(6, 6);

        $res = $dice->graphic();
        $exp = "dice-6";
        $this->assertEquals($exp, $res);
    }
}
