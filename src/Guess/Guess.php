<?php
namespace Hfn\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    private $number;
    private $tries;
    private $completed;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;

        $this->completed = false;

        if ($number != null) {
            if ($number == -1) {
                $this->random();
            }
        }
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random() : void
    {
        $this->number = rand(1, 100);
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries() : int
    {
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number() : int
    {
        return $this->number;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($guess) : string
    {

        if (empty($guess) || (int)$guess == 0) {
            return "<p>Not a valid guess</p>";
        }

        if ($this->tries > 0) {
            $this->tries = $this->tries - 1;
        }

        if ($guess < 1 || $guess > 100) {
            throw new GuessException("Guess must be between 1 and 100");
        }

        $res = 'Too low. ' .  $this->tries() . " tries left";
        $this->completed = false;

        if ($this->number() < $guess) {
            $res = 'Too high. ' . $this->tries() . " tries left";
        } elseif ($this->number() == $guess) {
             $res = 'Correct';
             $this->completed = true;
        }

        return "<p>You guessed " . $guess . ".</p><p>" . $res . "</p>";
    }

    /**
     * Determine if Game is completed or not
     *
     *
     * @return boolean true if Game is finished, otherwise false
     */
    public function completed() : bool
    {
        return $this->completed;
    }
}
