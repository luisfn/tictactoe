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
     * Test get a free random position
     */
    public function testRandomFreePosition()
    {
        $ttt = new TicTacToe();

        $pos = $ttt->getRandomFreePosition();

        $this->assertEquals(2, count($pos), 'Should return an array with 2 values');
    }

    /**
     * Tests if a player have completed a line
     */
    public function testIfPlayerCompletedLine() {
        $ttt = new TicTacToe();
        $human = new Human();

        $ttt->makeMove(0,0, $human);
        $ttt->makeMove(0,1, $human);
        $ttt->makeMove(0,2, $human);

        $this->assertTrue($ttt->checkLine(0, $human, 'Line should be completed'));
    }

    /**
     * Tests if a player have not completed a line
     */
    public function testIfPlayerHaveNotCompletedLine() {
        $ttt = new TicTacToe();
        $human = new Human();
        $bot = new Bot();

        $ttt->makeMove(0,0, $human);
        $ttt->makeMove(0,1, $bot);
        $ttt->makeMove(0,2, $human);

        $this->assertFalse($ttt->checkLine(0, $human, 'Line should not be completed'));
    }

    /**
     * Tests if a player have completed a column
     */
    public function testIfPlayerCompletedColumn() {
        $ttt = new TicTacToe();
        $human = new Human();

        $ttt->makeMove(0,0, $human);
        $ttt->makeMove(1,0, $human);
        $ttt->makeMove(2,0, $human);

        $this->assertTrue($ttt->checkColumn(0, $human, 'Column should be completed'));
    }

    /**
     * Tests if a player have not completed a Column
     */
    public function testIfPlayerHaveNotCompletedColumn() {
        $ttt = new TicTacToe();
        $human = new Human();
        $bot = new Bot();

        $ttt->makeMove(0,0, $human);
        $ttt->makeMove(1,0, $bot);
        $ttt->makeMove(2,0, $human);

        $this->assertFalse($ttt->checkColumn(0, $human, 'Column should not be completed'));
    }

    /**
     * Tests if a player have completed a diagonal
     */
    public function testIfPlayerCompletedDiagonal() {
        $ttt = new TicTacToe();
        $human = new Human();

        $ttt->makeMove(0,2, $human);
        $ttt->makeMove(1,1, $human);
        $ttt->makeMove(2,0, $human);

        $this->assertTrue($ttt->checkDiagonals($human), 'Diagonal should be completed');
    }

    /**
     * Tests if a player have completed a diagonal
     */
    public function testIfPlayerHaveNotCompletedDiagonal() {
        $ttt = new TicTacToe();
        $human = new Human();
        $bot = new Bot();

        $ttt->makeMove(0,2, $human);
        $ttt->makeMove(1,1, $bot);
        $ttt->makeMove(2,0, $human);

        $this->assertFalse($ttt->checkDiagonals($human), 'Diagonal should not be completed');
    }

    /**
     * Tests if a player have won
     */
    public function testIfPlayerWon() {
        $ttt = new TicTacToe();
        $human = new Human();

        $ttt->makeMove(0,0, $human);
        $ttt->makeMove(1,0, $human);
        $ttt->makeMove(2,0, $human);

        $this->assertTrue($ttt->checkVictory($human), 'Human player should have victory');
    }

    /**
     * Tests if a player have not won
     */
    public function testIfPlayerHaveNotWon() {
        $ttt = new TicTacToe();
        $human = new Human();
        $bot = new Bot();

        $ttt->makeMove(0,0, $human);
        $ttt->makeMove(1,0, $bot);
        $ttt->makeMove(2,0, $human);

        $this->assertFalse($ttt->checkVictory($human), 'Human player should have victory');
    }

}