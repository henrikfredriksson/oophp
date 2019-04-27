<?php

/**
 * A small guessing game in the course oophp
 * @author Henrik Fredriksson <hefa14@student.bth.se>
 */

require(__DIR__ . "/config.php");
require(__DIR__ . "/autoload.php");
require(__DIR__ . "/src/utils.php");

console_log($_SESSION);

// Handle variables from form (via process)
$guess = $_SESSION["guess"] ?? null;
$doInit = $_SESSION["doInit"] ?? null;
$doGuess = $_SESSION["doGuess"] ?? null;
$doCheat = $_SESSION["doCheat"] ?? null;
$number = $_SESSION["number"] ?? null;
$tries = $_SESSION["tries"] ?? null;
$game = null;
$res = null;
$error = null;



if ($doInit || $number == null) {
    $game = new Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
} elseif ($doGuess) {
    $game = new Guess($number, $tries);

    try {
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
    } catch (GuessException $e) {
        // console_log($e);
        $error = "<p>Guess must be between 1 and 100</p>";
    }
} elseif ($doCheat) {
    $game = new Guess($number, $tries + 1);
}



require(__DIR__ . "/view/index_view.php");
