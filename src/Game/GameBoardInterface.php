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

    /**
     * Checks if a player completed a line
     * @param int $line
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkLine(int $line, PlayerInterface $player) : bool;

    /**
     * Checks if a player completed a column
     * @param int $column
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkColumn(int $column, PlayerInterface $player) : bool;

    /**
     * Checks if a player completed a diagonal
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkDiagonals(PlayerInterface $player) : bool;

    /**
     * Checks is a player won the game
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkVictory(PlayerInterface $player) : bool;
}