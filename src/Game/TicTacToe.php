<?php

namespace TicTacToe\Game;

use TicTacToe\Player\Bot;
use TicTacToe\Player\PlayerInterface;

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
     * @param PlayerInterface $player
     * @return void
     */
    public function makeMove(int $x, int $y, PlayerInterface $player)
    {

        if ($x < 0 || $x > 2 || $y < 0 || $y > 2) {
            Throw new \InvalidArgumentException('Invalid board position');
        }

        if ($this->gameState[$x][$y]) {
            Throw new \InvalidArgumentException('Position  already used');
        }

        $this->gameState[$x][$y] = $player;
    }

    /**
     * Returns a PlayerInterface if any
     * @param int $x
     * @param int $y
     * @return mixed
     */
    public function getPosition(int $x, int $y)
    {
        if ($x < 0 || $x > 2 || $y < 0 || $y > 2) {
            Throw new \InvalidArgumentException('Invalid board position');
        }

        return $this->gameState[$x][$y];
    }

    /**
     * Dumb implementation of a random movement
     */
    public function computerMakeRandomMove()
    {
        $bot = new Bot();

        do {
            $randomX = mt_rand(0, 2);
            $randomY = mt_rand(0, 2);

            $freeSpace = $this->getPosition($randomX, $randomY) == null;

            if ($freeSpace) {
                $this->makeMove($randomX, $randomY, $bot);
            }

        } while ($freeSpace == false);
    }



}