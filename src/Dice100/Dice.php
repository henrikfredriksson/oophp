<?php

namespace Hfn\Dice100;

/**
 * Dice class
 */
class Dice
{
    /**
     * @var integer $value      The current value of the Dice
     * @var integer $sides      Sides of the dice
     * @var int     $lastRoll   Value of the last roll.
     */

    protected $value;
    protected $sides;
    protected $lastRoll;


    /**
     * Constructor to create Dice
     *
     * @param integer $value    initial value
     */
    public function __construct($sides = 6, $value = 1)
    {
        $this->sides = $sides;
        $this->value = $value;
    }

    /**
     * Roll the dice
     *
     * @return void
     */
    public function roll() : void
    {
        $this->value = rand(1, $this->sides);
    }


    /**
     * Returns the value of the dice
     *
     * @return int  value of the dice
     */
    public function getValue()
    {
        return $this->value;
    }
}
