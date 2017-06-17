<?php
declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;
use TicTacToe\Game\TicTacToe;
use TicTacToe\Player\Bot;
use TicTacToe\Player\Human;
use TicTacToe\Player\PlayerInterface;

/**
 * Tests for TicTacToe class
 * @package Tests
 */
class TicTacToeTest extends TestCase
{

    /**
     * Testing initial game state
     */
    public function testInitialStateShouldBeEmpty()
    {
        $ttt = new TicTacToe();

        $state = $ttt->getGameState();

        $this->assertEquals(3, count($state), 'Game Board should have 3 lines');

        foreach ($state as $line) {
            foreach ($line as $cell) {
                $this->assertNull($cell, 'Every cell should be null');
            }

            $this->assertEquals(3, count($line), 'Every line should have 3 cells');
        }
    }

    /**
     * Testing player move
     */
    public function testPlayerMove()
    {
        $ttt = new TicTacToe();
        $bot = new Bot();

        $ttt->makeMove(1, 2, $bot);
        $state = $ttt->getGameState();

        $this->assertEquals($bot, $state[1][2], 'Should have a player on this position');

    }

    /**
     * Testing position already occupied
     * @expectedException InvalidArgumentException
     */
    public function testPositionOccupiedMoveException()
    {
        $ttt = new TicTacToe();
        $bot = new Bot();
        $human = new Human();

        $ttt->makeMove(1, 2, $bot);
        $ttt->makeMove(1, 2, $human);
    }

    /**
     * Testing invalid board position
     * @expectedException InvalidArgumentException
     */
    public function testMoveToInvalidBoardPositionException()
    {
        $ttt = new TicTacToe();
        $bot = new Bot();

        $ttt->makeMove(3, -1, $bot);
    }

    /**
     * Testing get position
     */
    public function testGetSpecificPosition()
    {
        $ttt = new TicTacToe();
        $bot = new Bot();

        $ttt->makeMove(0, 0, $bot);

        $this->assertEquals($bot, $ttt->getPosition(0, 0), 'Should get an object');
        $this->assertInstanceOf(PlayerInterface::class, $ttt->getPosition(0, 0));

        $this->assertNull($ttt->getPosition(1, 1));
    }

    /**
     * Testing invalid board position
     * @expectedException InvalidArgumentException
     */
    public function testGetInvalidBoardPositionException()
    {
        $ttt = new TicTacToe();

        $ttt->getPosition(3, -1);
    }

    /**
     * Test random move
     */
    public function testRandomMove()
    {
        $ttt = new TicTacToe();
        $human = new Human();
        $ttt->makeMove(2, 2, $human);
        $ttt->computerMakeRandomMove();

        var_dump($ttt->getGameState());
    }

}