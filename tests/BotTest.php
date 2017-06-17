<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit_Framework_TestCase as TestCase;
use TicTacToe\Player\Bot;
use TicTacToe\Player\Human;

/**
 * Tests for TicTacToe class
 * @package Tests
 */
class BotTest extends TestCase
{

    /**
     * Testing player type
     */
    public function testIfPlayerIsHuman()
    {
        $player = new Bot();

        $this->assertEquals('bot', $player->getType(), 'Player type should be bot');
    }

    /**
     * Testing player symbol
     */
    public function testIfSymbolIsO()
    {
        $player = new Bot();

        $this->assertEquals('O', $player->getSymbol(), 'Player symbol should be O');
    }

}