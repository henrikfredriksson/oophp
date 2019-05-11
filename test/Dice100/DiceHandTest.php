<?php

namespace Hfn\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Test that a DiceHand instansiates
     * with correct amount of dices
     */
    public function testDiceHandHandSize()
    {
        $diceHand = new DiceHand(100);
        $diceHand->roll();

        $res = $diceHand->GetValues();
        $exp = 100;
        $this->assertCount($exp, $res);
    }

    /**
     * The average of 10000 dices, should be greater
     * than 3.2
     */
    public function testDiceHandLowerAverageValue()
    {
        $diceHand = new DiceHand(10000);
        $diceHand->roll();

        $res = $diceHand->average();

        $exp = 3.2;
        $this->assertGreaterThan($exp, $res);
    }

    /**
     * The average of 10000 dices, should be lower
     * than 3.7
     */
    public function testDiceHandUpperAverageValue()
    {
        $diceHand = new DiceHand(10000);
        $diceHand->roll();

        $res = $diceHand->average();

        $exp = 3.7;
        $this->assertLessThan($exp, $res);
    }

    /**
     * The sum of 1000 dices, should be greater
     * than 1000
     */
    public function testDiceHandLowerSumValue()
    {
        $diceHand = new DiceHand(1000);
        $diceHand->roll();

        $res = $diceHand->sum();

        $exp = 1000;
        $this->assertGreaterThan($exp, $res);
    }

    /**
     * The sum of 1000 dices, should be lower
     * than 6000
     */
    public function testDiceHandUpperSumValue()
    {
        $diceHand = new DiceHand(1000);
        $diceHand->roll();

        $res = $diceHand->sum();

        $exp = 6000;
        $this->assertLessThan($exp, $res);
    }
}
