<?php

namespace Anax\View;

require __DIR__ . "/toRGB.php";

?>

<style>

.buttons {
    margin: 10px;
}

.dice-sprite {
    display: -webkit-box;
    padding: 0;
    margin: 0 4px 0 0;
    width: 32px;
    height: 32px;
    background: url('../img/dice-faces.jpg') no-repeat;
}

.dice-sprite .dice-1 {
    background-position: -160px 0;
    outline: 2px solid red;
}

.dice-sprite .dice-2 {
    background-position: -128px 0;
}

.dice-sprite .dice-3 {
    background-position: -96px 0;
}

.dice-sprite .dice-4 {
    background-position: -64px 0;
}

.dice-sprite .dice-5 {
    background-position: -32px 0;
}

.dice-sprite .dice-6 {
    background-position: 0 0;
}

.dices {
    margin-left: 43%;
}


.scoreBar {
    display: inline-block;
    width: 500px;
    height: 30px;
    border: 1px solid black;
}

.score {
    width: 0px;
    height: 28px;
    max-width: 498px;
    background-color: red;
    text-align: right;
}

#currentScore {
    display: flex;
    width: 70vh;
    margin: 0 auto;
}

#currentScores li {
    display: block;
    margin: 0 0 5px 0;
}

#roll {
    background-color: lightgreen;
}

#save {
    background-color: lightblue;
}

#save:disabled {
    background-color: lightgrey;
}

</style>


<div id="container">
    <div>
        <h1>Tärningspelet 100</h1>
        <?php if (!$players) : ?>
            <h2>Starta ett nytt spel</h2>
            <p>Det ser ut som du försöker nå spelsidan utan att ha startat ett nytt spel</p>
            <input type="submit" name="doInit" value="Nytt spel">

        <?php else : ?>
            <?php if ($players[0]->getScore() + $players[1]->getScore() > 0) : ?>
            <h2>Nuvarande ställning</h2>
                <div id="currentScores">
                    <ul>
                        <li>
                        <div class="scoreBar">
                                <div
                                    class="score"
                                    style=
                                        "background-color: <?= toRGB($players[0]->getScore()) ?>;
                                        width: <?= 5*$players[0]->getScore()?>px">
                                <strong><?= $players[0]->getScore() <= 100 ? $players[0]->getScore() : "100" ?></strong>
                                </div>
                        </div>
                        Spelare
                        </li>
                        <li>
                            <div class="scoreBar">
                                <div class="score"
                                    style=
                                        "background-color: <?= toRGB($players[1]->getScore()) ?>;
                                        width: <?= 5*$players[1]->getScore() ?>px">
                            <strong><?= $players[1]->getScore() <= 100 ? $players[1]->getScore() : "100" ?></strong>
                                </div>
                            </div>
                            Marvin
                        </li>
                    </ul>
                </div>
            <?php endif; ?>




            <?php if ($players[0]->getScore() >= 100) : ?>
                <h1>Grattis, du vann över Marvin! </h1>
                <form method="POST">
                    <input type="submit" name="doInit" value="Nytt spel">
                </form>

            <?php elseif ($players[1]->getScore() >= 100) : ?>
                <h1>Tvärr, Marvin vann! </h1>
                <form method="POST">
                    <input type="submit" name="doInit" value="Nytt spel">
                </form>

            <?php else : ?>
            <h2>Nu spelar <?= $currentPlayer == 0 ? "du" : "Marvin" ?></h2>

            </div>

            <p>Poäng i potten: <?= $currentSum ?> </p>


            <div class="dices">

                <?php if ($graphics && $sum) : ?>
                    <p class="dice-sprite">
                        <?php foreach ($graphics as $value) : ?>
                            <i class="dice-sprite <?= $value ?>"></i>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>


            </div>
            <div id="form">
            <form method="POST">

            </div>
            <div id="buttons">
                <input id="roll" type="submit" name="doRoll" value=
                <?php

                if (!$currentPlayer) {
                    echo "Kasta tärningar";
                } else {
                    echo "Simulera Marvin";
                }

                ?>
                >

                <?php if ($currentPlayer == 0) : ?>
                <input id="save" type="submit" name="doSave" value="Spara"
                    <?php
                    if (!$continue || $currentPlayer == 1) {
                        echo "disabled";
                    }
                    ?>
                >
                <?php endif; ?>

                <input type="submit" name="doInit" value="Nytt spel">

            </form>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>



