<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?>

<style>

#form {
    width: 70vh;
}

#output {
    width: 70vh;
    font-size: 30px;
}

#buttons {
    margin-top: 20px;
    width: 70vh;
    display: flex;
    flex-flow: row | nowrap;
    overflow: hidden;
    flex-direction: row;
    justify-content: center;
}

.content {
    border: 1px solid black;
    background-color: #eef;
    padding: 2em;
    margin: 0 auto;
    height: auto;
    min-height: 300px;
    width: 800px;

    border-radius: 30px;
}

input[type='text'] {
    text-align: center;
    width: 70vh;
    background-color: #e8e8e8;
    color: black;
    font-size: 48px;
    border: 2px solid grey;
    border-radius: 4px;
}

input[type='text']:disabled {
    background-color: #555;
    color: rgb(200, 199, 199);
}

input[type='submit'] {
    font-family: 'IBM Plex Mono', sans-serif;
    font-weight: bold;
    text-align: center;
    width: 24vh;
    background-color: #e8e8e8;
    color: black;
    font-size: 48px;
    border: 1px solid grey;
    border-radius: 1px;
}

input[type='submit']:disabled,
button:disabled {
    color: rgb(200, 199, 199);
}

input[type='submit']:active {
    background-color: grey;
}

.clear {
    background-color: green; /* Green */
    border: none;
    color: salmon;
    padding: 2px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 48px;
    font-family: 'Arial', 'Comic Sans MS';
}

.text {
    width: 700px;
    margin: 0 auto;
}



a,
a:visited {
    color: lightblue;
    text-decoration: none;
}

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


