<?php

namespace TicTacToe\Game;

class TicTacToe implements GameBoardInterface
{
    /**
     * @var
     */
    private $gameState;

    /**
     * TicTacToe constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Returns current game state
     * @return array
     */
    public function getGameState() : array
    {
        return $this->gameState;
    }

    /**
     * Initialize Game Board
     * @return void
     */
    public function initialize()
    {
        $this->gameState = [
            [null, null, null],
            [null, null, null],
            [null, null, null],
        ];
    }

    /**
     * Make a piece move
     * @param int $x
     * @param int $y
     * @param string $player
     * @return void
     */
    public function makeMove(int $x, int $y, string $player)
    {
        // TODO: Implement makeMove() method.
    }
}