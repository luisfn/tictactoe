<?php
declare(strict_types=1);

namespace Tests;


use PHPUnit_Framework_TestCase as TestCase;
use TicTacToe\Player\Human;

/**
 * Tests for TicTacToe class
 * @package Tests
 */
class HumanTest extends TestCase
{

    /**
     * Testing player type
     */
    public function testIfPlayerIsHuman()
    {
        $player = new Human();

        $this->assertEquals('human', $player->getType(), 'Player type should be human');
    }

    /**
     * Testing player symbol
     */
    public function testIfSymbolIsX()
    {
        $player = new Human();

        $this->assertEquals('X', $player->getSymbol(), 'Player symbol should be X');
    }

}