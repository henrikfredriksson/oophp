<?php
require __DIR__ . "/config.php";


/**
 * A processing page that stores form data in session and does a redirect.
 */


$_SESSION["guess"] = $_POST["guess"] ?? null;
$_SESSION["doInit"] = $_POST["doInit"] ?? null;
$_SESSION["doGuess"] = $_POST["doGuess"] ?? null;
$_SESSION["doCheat"] = $_POST["doCheat"] ?? null;


// Redirect to a result page.
$url = "index.php";
header("Location: $url");
