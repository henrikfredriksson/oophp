<?php

namespace Hfn\Dice100;

use PHPUnit\Framework\TestCase;

// use Anax\Session\Session;

/**
 * Example test class.
 */
class GameTest extends TestCase
{

    public function setUp()
    {
        // if (!isset($_SESSION)) {
        //     session_name("test");
        //     session_start();

        // }
        $this->session = new \Anax\Session\Session();


        // $request = new \Anax\Request\Request();
        $this->game = new Game(2, 2, null, $this->session);
    }

    /**
     * getPlayer should return instance of Hfn\Dice100\Player
     *
     * @return void
     */
    public function testGameGetPlayer()
    {
        $res = $this->game->getPlayer(0);

        $this->assertInstanceOf("Hfn\Dice100\Player", $res);
    }

    /**
     * getPlayer should return instance of Hfn\Dice100\Player
     *
     * @return void
     */
    public function testGameGetPlayerUndefinedIndex()
    {
        $this->expectException(PlayerIndexException::class);
        $this->game->getPlayer(-10);
    }

    /**
     * Test if game is instansiated with correct number of players
     */
    public function testGameNumberOfPlayers()
    {
        $res = $this->game->getPlayers();
        $exp = 2;
        $this->assertCount($exp, $res);
    }

    /**
     * A player rolling 1 should not be allowed to play
     */
    public function testGameShouldPlayerContinueFalse()
    {
        $exp = $this->game->shouldCurrentPlayerContinue([5,1,2,3]);

        $res = false;
        $this->assertEquals($exp, $res);
    }

    /**
     * A player not rolling 1 should be allowed to continue
     */
    public function testGameShouldPlayerContinueTrue()
    {
        $exp = $this->game->shouldCurrentPlayerContinue([5,6,2,3,6,3]);

        $res = true;
        $this->assertEquals($exp, $res);
    }

    /**
     * Player should be allowed to continue after save
     */
    public function testGameSave()
    {
        $this->game->play(0);

        $this->game->save(0);

        $res = $this->session->get("continue");

        $this->assertFalse($res);
    }

    /**
     * Marvin should be allowed to continue after save
     */
    public function testGameSave1()
    {

        $this->game->play(1);

        $this->game->save(1);

        $res = $this->session->get("continue");

        $this->assertFalse($res);
    }

    public function testGamePlayerException()
    {
        $this->expectException(PlayerIndexException::class);
        throw new PlayerIndexException();
    }
}
