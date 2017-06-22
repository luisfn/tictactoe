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
     * @var
     */
    private $ttt;

    public function setUp()
    {
        $session = $this->getMock('\Symfony\Component\HttpFoundation\Session\Session');

        $this->ttt = new TicTacToe($session);
    }

    /**
     * Testing initial game state
     */
    public function testInitialStateShouldBeEmpty()
    {
        $state = $this->ttt->getGameState();

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
        $bot = new Bot();

        $this->ttt->makeMove(1, 2, $bot);
        $state = $this->ttt->getGameState();

        $this->assertEquals($bot, $state[1][2], 'Should have a player on this position');

    }

    /**
     * Testing position already occupied
     * @expectedException InvalidArgumentException
     */
    public function testPositionOccupiedMoveException()
    {
        $bot = new Bot();
        $human = new Human();

        $this->ttt->makeMove(1, 2, $bot);
        $this->ttt->makeMove(1, 2, $human);
    }

    /**
     * Testing invalid board position
     * @expectedException InvalidArgumentException
     */
    public function testMoveToInvalidBoardPositionException()
    {
        $bot = new Bot();

        $this->ttt->makeMove(3, -1, $bot);
    }

    /**
     * Testing get position
     */
    public function testGetSpecificPosition()
    {
        $bot = new Bot();

        $this->ttt->makeMove(0, 0, $bot);

        $this->assertEquals($bot, $this->ttt->getPosition(0, 0), 'Should get an object');
        $this->assertInstanceOf(PlayerInterface::class, $this->ttt->getPosition(0, 0));
        $this->assertNull($this->ttt->getPosition(1, 1));
    }

    /**
     * Testing invalid board position
     * @expectedException InvalidArgumentException
     */
    public function testGetInvalidBoardPositionException()
    {
        $this->ttt->getPosition(3, -1);
    }

    /**
     * Test get a free random position
     */
    public function testRandomFreePosition()
    {
        $pos = $this->ttt->getRandomFreePosition();

        $this->assertEquals(2, count($pos), 'Should return an array with 2 values');
    }

    /**
     * Tests if a player have completed a line
     */
    public function testIfPlayerCompletedLine() {
        $human = new Human();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(0,1, $human);
        $this->ttt->makeMove(0,2, $human);

        $this->assertTrue($this->ttt->checkLine($this->ttt->getGameState(), 0, $human, 'Line should be completed'));
    }

    /**
     * Tests if a player have not completed a line
     */
    public function testIfPlayerHaveNotCompletedLine() {
        $human = new Human();
        $bot = new Bot();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(0,1, $bot);
        $this->ttt->makeMove(0,2, $human);

        $this->assertFalse($this->ttt->checkLine($this->ttt->getGameState(), 0, $human, 'Line should not be completed'));
    }

    /**
     * Tests if a player have completed a column
     */
    public function testIfPlayerCompletedColumn() {
        $human = new Human();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(1,0, $human);
        $this->ttt->makeMove(2,0, $human);

        $this->assertTrue($this->ttt->checkColumn($this->ttt->getGameState(), 0, $human, 'Column should be completed'));
    }

    /**
     * Tests if a player have not completed a Column
     */
    public function testIfPlayerHaveNotCompletedColumn() {
        $human = new Human();
        $bot = new Bot();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(1,0, $bot);
        $this->ttt->makeMove(2,0, $human);

        $this->assertFalse($this->ttt->checkColumn($this->ttt->getGameState(), 0, $human, 'Column should not be completed'));
    }

    /**
     * Tests if a player have completed a diagonal
     */
    public function testIfPlayerCompletedDiagonal() {
        $human = new Human();

        $this->ttt->makeMove(0,2, $human);
        $this->ttt->makeMove(1,1, $human);
        $this->ttt->makeMove(2,0, $human);

        $this->assertTrue($this->ttt->checkDiagonals($this->ttt->getGameState(), $human), 'Diagonal should be completed');
    }

    /**
     * Tests if a player have completed a diagonal
     */
    public function testIfPlayerHaveNotCompletedDiagonal() {
        $human = new Human();
        $bot = new Bot();

        $this->ttt->makeMove(0,2, $human);
        $this->ttt->makeMove(1,1, $bot);
        $this->ttt->makeMove(2,0, $human);

        $this->assertFalse($this->ttt->checkDiagonals($this->ttt->getGameState(), $human), 'Diagonal should not be completed');
    }

    /**
     * Tests if a player have won
     */
    public function testIfPlayerWon() {
        $human = new Human();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(1,0, $human);
        $this->ttt->makeMove(2,0, $human);

        $this->assertTrue($this->ttt->checkVictory($this->ttt->getGameState(), $human), 'Human player should have victory');
    }

    /**
     * Tests if a player have not won
     */
    public function testIfPlayerHaveNotWon() {
        $human = new Human();
        $bot = new Bot();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(1,0, $bot);
        $this->ttt->makeMove(2,0, $human);

        $this->assertFalse($this->ttt->checkVictory($this->ttt->getGameState(), $human), 'Human player should have victory');
    }

    /**
     * Test bot move for victory
     */
    public function testBotBetterMoveCheckVictory()
    {
        $bot = new Bot();

        $this->ttt->makeMove(0,0, $bot);
        $this->ttt->makeMove(0,2, $bot);

        $pos = $this->ttt->getBetterMove();

        $this->assertEquals([0,1], $pos, 'Bot should win');
    }

    /**
     * Test bot move blocking human victory
     */
    public function testBotBetterMoveBlockHumanVictory()
    {
        $human = new Human();

        $this->ttt->makeMove(0,0, $human);
        $this->ttt->makeMove(0,2, $human);

        $pos = $this->ttt->getBetterMove();

        $this->assertEquals([0,1], $pos, 'Bot should block');
    }

    /**
     * Test bot for using middle position
     */
    public function testBotBetterMoveUseMiddle()
    {
        $human = new Human();

        $this->ttt->makeMove(0,0, $human);

        $pos = $this->ttt->getBetterMove();

        $this->assertEquals([1,1], $pos, 'Bot should block');
    }

    /**
     * Test bot for free corner
     */
    public function testBotBetterMoveUseFreeCorner()
    {
        $human = new Human();

        $this->ttt->makeMove(1,1, $human);

        $pos = $this->ttt->getBetterMove();

        $this->assertEquals([0,0], $pos, 'Bot should block');
    }

    /**
     * Test bot for free corner
     */
    public function testGetRandomFreePosition()
    {
        $pos = $this->ttt->getRandomFreePosition();

        $this->assertEquals(2, count($pos), 'Should return array with x y positions');
    }
}