<?php

namespace TicTacToe\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @var Session
     */
    private $session;

    /**
     * TicTacToe constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        $this->loadGameState();
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
     * Returns current free positions
     * @return array
     */
    public function getFreePositions() : array
    {
        return $this->freePositions;
    }

    /**
     * Initialize Game Board
     * @return void
     */
    public function initialize()
    {
        if (!$this->session->get('freePositions')) {
            $this->freePositions = [
                [0,0], [0,1], [0,2], [1,0], [1,1], [1,2], [2,0], [2,1], [2,2]
            ];
        }

        if (!$this->session->get('gameState')) {
            $this->gameState = [
                [null, null, null],
                [null, null, null],
                [null, null, null],
            ];
        }

        $this->storeGameState();
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

        $this->storeGameState();
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

    /**
     * Checks if a player completed a line
     * @param int $line
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkLine(int $line, PlayerInterface $player): bool
    {
        return $this->getPosition($line, 0) == $player &&
               $this->getPosition($line, 1) == $player &&
               $this->getPosition($line, 2) == $player;
    }

    /**
     * Checks if a player completed a column
     * @param int $column
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkColumn(int $column, PlayerInterface $player): bool
    {
        return $this->getPosition(0, $column) == $player &&
               $this->getPosition(1, $column) == $player &&
               $this->getPosition(2, $column) == $player;
    }

    /**
     * Checks if a player completed a diagonal
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkDiagonals(PlayerInterface $player): bool
    {
        return ($this->getPosition(0, 0) == $player &&
                $this->getPosition(1, 1) == $player &&
                $this->getPosition(2, 2) == $player) ||
               ($this->getPosition(0, 2) == $player &&
                $this->getPosition(1, 1) == $player &&
                $this->getPosition(2, 0) == $player);
    }

    /**
     * Checks is a player won the game
     * @param PlayerInterface $player
     * @return bool
     */
    public function checkVictory(PlayerInterface $player): bool
    {
        return $this->checkDiagonals($player) ||
               $this->checkLine(0, $player) ||
               $this->checkLine(1, $player) ||
               $this->checkLine(2, $player) ||
               $this->checkColumn(0, $player) ||
               $this->checkColumn(1, $player) ||
               $this->checkColumn(2, $player);
    }

    /**
     * Check if there is game data on the session and populate the class
     */
    public function loadGameState()
    {
        if ($this->session->get('freePositions')) {
            $this->freePositions = $this->session->get('freePositions');
        }

        if ($this->session->get('gameState')) {
            $this->gameState = $this->session->get('gameState');
        }
    }

    /**
     * Transfer class data to the session
     */
    public function storeGameState()
    {
        $this->session->set('freePositions', $this->freePositions);
        $this->session->set('gameState', $this->gameState);
    }

    /**
     * Clear the game session
     */
    public function resetGameState()
    {
        $this->session->clear();
    }
}