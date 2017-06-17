<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game\TicTacToe;

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

}