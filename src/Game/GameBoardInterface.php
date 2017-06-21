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
     * @param array $gameState
     * @param int $line
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkLine(array $gameState, int $line, PlayerInterface $player) : bool;

    /**
     * Checks if a player completed a column
     * @param array $gameState
     * @param int $column
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkColumn(array $gameState, int $column, PlayerInterface $player) : bool;

    /**
     * Checks if a player completed a diagonal
     * @param array $gameState
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkDiagonals(array $gameState, PlayerInterface $player) : bool;

    /**
     * Checks is a player won the game
     * @param array $gameState
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkVictory(array $gameState, PlayerInterface $player) : bool;
}