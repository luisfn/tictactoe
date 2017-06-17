<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Tests for TicTacToe class
 * @package Tests
 */
class TicTacToeTest extends TestCase
{

    /**
     * @var array
     */
    private $expectedInitialState = [
        [null, null, null],
        [null, null, null],
        [null, null, null]
    ];

    /**
     * Testing initial game state
     */
    public function testInitialStateShouldBeEmpty()
    {
        $ttt = new TicTacToe();

        $state = $ttt->getGameState();

        foreach ($state as $line) {
            foreach ($line as $cell) {
                $this->assertNull($cell);
            }
        }
    }

}