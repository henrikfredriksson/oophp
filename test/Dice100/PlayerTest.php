<?php

namespace Hfn\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class PlayerTest extends TestCase
{
    public function setUp()
    {
        $this->player = new Player();
    }

    /**
     * A default should:
     *  have an instance of a DiceHand
     *  have 0 score
     *
     * @return void
     */
    public function testPlayerDefaultSettings()
    {
        $res = $this->player->getHand();

        $this->assertInstanceOf("Hfn\Dice100\DiceHand", $res);

        $res = $this->player->getScore();

        $exp = 0;
        $this->assertEquals($exp, $res);
    }


    /**
     * Test that score is updated correctly
     */

    public function testPlayerSaveScore()
    {
        $this->player->saveScore(101);
        $res = $this->player->getScore();

        $exp = 101;
        $this->assertEquals($exp, $res);
    }


    public function testDiceGraphicContainDice()
    {
        $res = $this->player->graphics();
        $exp = "dice-1";
        $this->assertEquals($exp, $res[0]);
    }
}
