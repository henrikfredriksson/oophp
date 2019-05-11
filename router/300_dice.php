<?php

namespace Hfn\Dice100;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Reset the session and redirect to createGame
 */
$app->router->get("dice/init", function () use ($app) {
    // Reset the session
    $app->session->destroy();
    $app->session->start();

    return $app->response->redirect("dice/createGame");
});


/**
 * Creates a new game, save players in session and redirects to play
 */
$app->router->get("dice/createGame", function () use ($app) {
    $game = new Game(2, 2);

    $app->session->set("players", $game->getPlayers());

    $app->session->set("currentPlayer", 0);
    $app->session->set("currentSum", 0);

    return $app->response->redirect("dice/play");
});

/**
 * Handle post request for the game
 */
$app->router->post("dice/play", function () use ($app) {
    $request = new \Anax\Request\Request();

    $players = $app->session->get("players");

    $game = new Game(2, 2, $players, $app->session);

    $doRoll  = $request->getPost("doRoll", null);
    $doSave  = $request->getPost("doSave", null);
    $doInit  = $request->getPost("doInit", null);

    $current = $app->session->get("currentPlayer");

    if ($doInit) {
        return $app->response->redirect("dice-game");
    }

    if ($doRoll) {
        $game->play($current);
    }

    if ($doSave) {
        $game->save($current);
    }

    $app->session->set("players", $game->getPlayers());

    return $app->response->redirect("dice/nextplayer");
});


/**
 * Updates the next playe
 */
$app->router->get("dice/nextplayer", function () use ($app) {

    if (!$app->session->get("continue")) {
        $current = $app->session->get("currentPlayer");
        $app->session->set("currentPlayer", ($current + 1) % 2);
    }

    return $app->response->redirect("dice/play");
});


/**
 * Render the page
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Tärningsspelet 100";

    $data = [
        "continue"      => $app->session->get("continue") ?? null,
        "currentSum"    => $app->session->get("currentSum") ?? null,
        "currentPlayer" => $app->session->get("currentPlayer") ?? null,
        "players"       => $app->session->get("players") ?? null,
        // "series"        => $app->session->get("series") ?? null,
        "sum"           => $app->session->get("sum") ?? null,
        "graphics"      => $app->session->get("graphics") ?? null,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("dice/debug", [
    //     "when" => "AFTER"
    // ]);

    return $app->page->render([
            "title" => $title,
        ]);
});
