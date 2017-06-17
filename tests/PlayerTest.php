<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use TicTacToe\Player\Player;

/**
 * Tests for TicTacToe class
 * @package Tests
 */
class PlayerTest extends TestCase
{

    /**
     * Testing player type
     */
    public function testIfPlayerIsHuman()
    {
        $player = new Player('human', 'O');

        $this->assertEquals('human', $player->getType(). 'Player type should be human');
    }

    /**
     * Testing player type
     */
    public function testIfPlayerIsBot()
    {
        $player = new Player('bot', 'X');

        $this->assertEquals('bot', $player->getType(). 'Player type should be bot');
    }

    /**
     * Testing player symbol
     */
    public function testIfSymbolIsX()
    {
        $player = new Player('bot', 'X');

        $this->assertEquals('X', $player->getSymbol(). 'Player symbol should be X');
    }

}