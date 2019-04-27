<link rel='stylesheet' type='text/css' href='./src/css/style.css' />

<div id="header">
    Henrik Fredriksson | oophp | <a href="./reset.php">Destroy session</a>
</div>



<div id="container">
    <div id="title">
        <h1>Guess my number</h1>
    </div>
    <div id="form">
    <form method="POST" action="post-process.php">
        <input type="text" name="guess" id="guess"
        <?php
        if ($game != null) {
            if (($game->tries() <= 0) || $game->completed()) {
                echo 'disabled placeholder="Game finished"';
            } else {
                echo 'placeholder="Enter your guess"';
            }
        } else {
                echo 'placeholder="Enter your guess"';
        }
        ?>
        >
    </div>
    <div id="buttons">
        <input type="submit" name="doGuess" value="Guess"
        <?php
        if ($game != null) {
            if (($game->tries() <= 0) || $game->completed()) {
                echo "disabled";
            }
        }
        ?>
        >
        <input type="submit" name="doCheat" value="Cheat"
        <?php
        if ($game != null) {
            if (($game->tries() <= 0) || $game->completed()) {
                echo "disabled";
            }
        }
        ?>
        >
        <input type="submit" name="doInit" value="New game">

        <input type="hidden" name="tries" value="<?= $game != null ? $game->tries() : '' ?>">

    </form>
    </div>
    <div id="output">
    <?php
    if ($error) {
        echo $error;
    } elseif ($game) {
        if ($doGuess) {
            echo $res;
            console_log($game->tries() . " tries left");
        }

        if ($doCheat) {
            echo "<p>Correct number is " . $game->number() . "</p>";
            console_log("The correct number is: " . $game->number());
        }
    }
    ?>
    </div>
</div>

