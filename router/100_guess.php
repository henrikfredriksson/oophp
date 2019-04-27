<?php


/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // init the sessions for the gamestart
    $game = new Hfn\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game - make a guess
 */
$app->router->post("guess/play", function () use ($app) {

    $guess   = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doInit  = $_POST["doInit"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $number  = $_POST["number"] ?? null;
    $tries   = $_POST["tries"] ?? null;

    $_SESSION = null;

    if ($doGuess) {
        $game = new Hfn\Guess\Guess($number, $tries);

        try {
            $res = $game->makeGuess($guess);
        } catch (Hfn\Guess\GuessException $e) {
            $error = "<p>Guess must be between 1 and 100</p>";
        }

        $_SESSION["number"]       = $game->number();
        $_SESSION["tries"]        = $game->tries();
        $_SESSION["res"]          = $res ?? null;
        $_SESSION["doGuess"]      = $doGuess ?? null;
        $_SESSION["error"]        = $error ?? null;
        $_SESSION["game_finished"] = $game->completed();
    } elseif ($doInit) {
        $game = new Hfn\Guess\Guess();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
    }

    $_SESSION["doCheat"] = $_POST["doCheat"] ?? null;


    return $app->response->redirect("guess/play");
});


/**
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Guess game";

    $data = [
        "guess"        => $_SESSION["guess"] ?? null,
        "res"          => $_SESSION["res"] ?? null,
        "number"       => $_SESSION["number"] ?? null,
        "doCheat"      => $_SESSION["doCheat"] ?? null,
        "doGuess"      => $_SESSION["doGuess"] ?? null,
        "tries"        => $_SESSION["tries"] ?? null,
        "error"        => $_SESSION["error"] ?? null,
        "game_finished" => $_SESSION["game_finished"] ?? false,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug", [
        "when" => "AFTER"
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Showing message Hello World, rendered within the standard page layout.
 */
$app->router->get("lek/hello-world-page", function () use ($app) {
    $title = "Hello World as a page";
    $data = [
        "class" => "hello-world",
        "content" => "Hello World in " . __FILE__,
    ];

    $app->page->add("anax/v2/article/default", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
