<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?>

<style>


</style>

<div id="container">
    <div>
        <h1>Guess my number</h1>
    </div>
    <div id="form">
    <!-- <form method="POST" action="post-process.php"> -->
    <form method="POST">
        <input type="text" name="guess" id="guess"
        <?php
        // if ($game != null) {
        if ($tries <= 0 || $game_finished) {
            echo 'disabled placeholder="Game finished"';
        } else {
            echo 'placeholder="Enter your guess"';
        }
        // } else {
        //         echo 'placeholder="Enter your guess"';
        // }
        ?>
        >
    </div>
    <div id="buttons">
        <input type="submit" name="doGuess" value="Guess"
        <?php
        // if ($game != null) {
        if ($tries <= 0 || $game_finished) {
            echo "disabled";
        }
        // }
        ?>
        >
        <input type="submit" name="doCheat" value="Cheat"
        <?php
        // if ($game != null) {
        if ($tries <= 0 || $game_finished) {
            echo "disabled";
        }
        // }
        ?>
        >
        <input type="submit" name="doInit" value="New game">
        <input type="hidden" name="tries" value="<?= $tries ?>">
        <input type="hidden" name="number" value="<?= $number ?>">
    </form>
    </div>

    <div id="output">
    <?php
    if ($error) {
        echo $error;
    } else {
        if ($doGuess) {
            echo $res;
            // console_log($game->tries() . " tries left");
        }

        if ($doCheat) {
            echo "<p>Correct number is " . $number . "</p>";
        }
    }
    ?>
    </div>
</div>


