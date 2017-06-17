<?php

namespace TicTacToe\Player;

/**
 * Class Player
 * @package TicTacToe\Player
 */
class Player implements PlayerInterface
{
    /**
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $symbol;

    /**
     * Player constructor.
     * @param $type
     * @param $symbol
     */
    public function __construct(string $type, string $symbol)
    {
        $this->type = $type;
        $this->symbol = $symbol;
    }

    /**
     * Reteives player type
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Reteives player symbol
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }
}