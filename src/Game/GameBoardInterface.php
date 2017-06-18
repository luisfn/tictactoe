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

    /**
     * Returns a PlayerInterface if any
     * @param int $x
     * @param int $y
     * @return PlayerInterface
     */
    public function getPosition(int $x, int $y);

    /**
     * Returns a randon free position from freePositions Array
     * @return array
     */
    public function getRandomFreePosition() : array;
}