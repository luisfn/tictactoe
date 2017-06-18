<?php

namespace TicTacToe\Game;

use TicTacToe\Player\PlayerInterface;

class TicTacToe implements GameBoardInterface
{
    /**
     * @var
     */
    private $gameState;

    /**
     * @var
     */
    private $freePositions;

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

        $this->freePositions = [
            [0,0], [0,1], [0,2], [1,0], [1,1], [1,2], [2,0], [2,1], [2,2]
        ];

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

        $this->removeFreePosition([$x, $y]);
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
     * Returns a randon free position from freePositions Array
     * @return array
     */
    public function getRandomFreePosition(): array
    {
        if (empty($this->freePositions) ) {
            throw new \InvalidArgumentException('There are no free positions');
        }

        $randomIndex = mt_rand(0, count($this->freePositions) - 1);

        return $this->freePositions[$randomIndex];
    }

    /**
     * Removes a position from freePositions array
     * @param $position
     */
    private function removeFreePosition($position)
    {
        $index = array_search($position, $this->freePositions);
        unset($this->freePositions[$index]);
        $this->freePositions = array_values($this->freePositions);
    }
}