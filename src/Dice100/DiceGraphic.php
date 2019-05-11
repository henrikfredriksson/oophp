<?php

namespace Hfn\Dice100;

/**
 * A graphic dice.
 */
class DiceGraphic extends Dice
{
    /**
     * Constructor to initiate the dice with six number of sides.
     */
    public function __construct($sides = 6, $value = 1)
    {
            parent::__construct($sides, $value);
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic() : string
    {
        return "dice-" . $this->getValue();
    }
}
