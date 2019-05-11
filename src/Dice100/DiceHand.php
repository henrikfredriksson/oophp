<?php

namespace Hfn\Dice100;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var array DiceGraphic $dices   Array consisting of dices.
     * @var int $numberOfDices         Number of dice in the hand
     * @var array int $values          Array consisting of last roll of the dices.
     */

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices    Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->numberOfDices = $dices;

        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $this->numberOfDices; $i++) {
            $this->dices[]  = new DiceGraphic();
            $this->values[] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll() : void
    {
        for ($i = 0; $i < $this->numberOfDices; $i++) {
            $this->dices[$i]->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function getValues() : array
    {
        $this->values = [];
        for ($i = 0; $i < $this->numberOfDices; $i++) {
            array_push($this->values, $this->dices[$i]->getValue());
        }

        return $this->values;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum() : int
    {
        $sum = 0;
        for ($i = 0; $i <  $this->numberOfDices; $i++) {
            $sum += $this->dices[$i]->getValue();
        }

        return $sum;
    }

    /**
     * Returns an array of strings with the
     * graphical representation of DiceHand
     *
     * @return array    strings with graphical representation of Dices in DiceHand
     */
    public function getGraphics() : array
    {
        $this->values = [];
        for ($i = 0; $i < $this->numberOfDices; $i++) {
            array_push($this->values, $this->dices[$i]->graphic());
        }

        return $this->values;
    }

    /**
     * Returns the average of all dices with 3 decimal precission
     *
     * @return float as the average of all dices.
     */
    public function average() : float
    {
        return round($this->sum()/$this->numberOfDices, 3);
    }
}
