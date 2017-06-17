<?php

namespace TicTacToe\Game;

interface GameBoardInterface
{
    /**
     * Returns current game state
     * @return array
     */
    public function getGameState() : array;

    /**
     * Initialize Game Board
     * @return void
     */
    public function initialize();

    /**
     * Make a piece move
     * @param int $x
     * @param int $y
     * @param string $player
     * @return void
     */
    public function makeMove(int $x, int $y, string $player);
}