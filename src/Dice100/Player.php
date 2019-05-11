<?php

namespace Hfn\Dice100;

/**
 * Player class for Dice 100 game
 *
 */
class Player
{
    /**
     * @var int      $score     Score of the player
     * @var DiceHand $hand      Hand of dices
     * @var int[]    $rolls     History of players rolls
     */

    private $score = 0;
    private $hand = null;
    public $rolls = [];

    /**
     * Constructor. Creates a player with DiceHand
     *
     * @param integer $numberOfDices
     * @return void
     */
    public function __construct(int $numberOfDices = 2)
    {
        $this->hand = new DiceHand($numberOfDices);
    }

    public function getHand() : DiceHand
    {
        return $this->hand;
    }

    /**
     * Updates the score the player
     *
     * @param integer $score
     * @return void
     */
    public function saveScore(int $score = 0)
    {
        $this->score += $score;
    }

    /**
     * Return the score for the player
     *
     * @return integer  Current score of player
     */
    public function getScore() : int
    {
        return $this->score;
    }

    /**
     * Roll the players DiceHand
     */
    public function roll() : void
    {
        $this->getHand()->roll();
    }

    /**
     * Return the graphical representation of the DiceHand
     *
     * @return array
     */
    public function graphics() : array
    {
        return $this->getHand()->getGraphics();
    }

    /**
     * Save the roll history for the player
     *
     * @param array $roll
     * @return void
     */
    public function updateRolls(array $roll) : void
    {
        array_push($this->rolls, $roll);
    }
}
