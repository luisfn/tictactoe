<?php

namespace TicTacToe\Game;

use TicTacToe\Player\PlayerInterface;

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
     * @param PlayerInterface $player
     * @return void
     */
    public function makeMove(int $x, int $y, PlayerInterface $player);
}