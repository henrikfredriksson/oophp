<?php

namespace Hfn\Dice100;

// require_once __DIR__ . "/../utils.php";

class Game
{
    /**
     * @var Player[] $players      Players playing the game
     * @var int $currentPlayer      Index of player currently playing
     * @var int $numberOfPlayers    The number of players
     * @var Anax\Session $session   Session
     */

    public $players = [];
    public $currentPlayer = 0;

    private $numberOfPlayers;
    private $session = null;


    /**
     * Contructor
     *
     * @param integer $numberOfPlayers
     * @param integer $numberOfDices
     * @param array $players
     * @param object $session
     */
    public function __construct(
        int    $numberOfPlayers = 2,
        int    $numberOfDices = 2,
        array  $players = null,
        object $session = null
    ) {
        $this->numberOfPlayers = $numberOfPlayers;
        $this->players = $players;

        if ($players == null) {
            for ($i=0; $i < $numberOfPlayers; $i++) {
                $this->players[] = new Player($numberOfDices);
            }
        }

        $this->session = $session;
    }

    /**
     * Returns the players of the game
     *
     * @return array    Player
     */
    public function getPlayers() : array
    {
        return $this->players;
    }

    /**
     * Return player with index $id.
     * Raises PlayerIndexException of index not valid.
     *
     * @param integer $id   Player index
     * @return Player
     */
    public function getPlayer(int $id) : Player
    {
        if ($id < 0 || $id > $this->numberOfPlayers) {
            throw new PlayerIndexException;
        }

        return $this->players[$id];
    }


    /**
     * Roll the dices of Player with index $playerIndex
     * Determines if a player is allowed to continue
     *
     * TOOD: Break into smaller functions
     *
     * @param int $playerIndex
     * @return void
     */
    public function play(int $playerIndex) : void
    {
        $hand = $this->getPlayer($playerIndex)->getHand();

        $hand->roll();

        $roll     = $hand->getValues();
        $sum      = $hand->sum();
        $graphics = $hand->getGraphics();


        $this->getPlayer($playerIndex)->updateRolls($roll);

        $playerHistory = "p" . $playerIndex;
        $history = $this->getPlayer($playerIndex)->rolls;
        $this->session->set($playerHistory, $history);

        $this->session->set("series", $roll);
        $this->session->set("sum", $sum);
        $this->session->set("graphics", $graphics);


        $currentSum = $sum + $this->session->get("currentSum");


        $this->session->set("currentSum", $currentSum);
        $this->session->set("continue", true);

        $continue = $this->shouldCurrentPlayerContinue($roll);

        if (!$continue) {
            $this->session->set("continue", false);
            $this->session->set("currentSum", 0);
        }

        if ($playerIndex == 1 && $this->session->get("continue")) {
            $this->marvin();
        }
    }



    /**
     * Return false if array contains 1, otherwise true
     *
     * @param array $roll   dice rolls
     * @return boolean
     */
    public function shouldCurrentPlayerContinue(array $roll) : bool
    {
        if (in_array(1, $roll)) {
            return false;
        }
        return true;
    }

    /**
     * "AI" for Marvin
     */
    public function marvin() : void
    {
        $playerScore = $this->getPlayer(0)->getScore();
        $aiScore = $this->getPlayer(1)->getScore();

        $virtualSum = $this->getPlayer(1)->getScore() + $this->session->get("sum");

        if ($aiScore > 0) {
            $ratio = $playerScore/$virtualSum;

            if ($ratio > 1.3) {
                $this->save(1);
            } elseif ($ratio > 1.1) {
                    $this->play(1);
            } else {
                $this->save(1);
            }
        }

        if ($aiScore == 0) {
            $this->save(1);
        }
    }

    /**
     * Save the score for player with index $playerIndex
     *
     * @param int $playerIndex
     * @return void
     */
    public function save(int $playerIndex) : void
    {
        $score = $this->session->get("currentSum");

        $this->getPlayer($playerIndex)->saveScore($score);

        $this->session->set("continue", false);
        $this->session->set("currentSum", 0);
    }
}
