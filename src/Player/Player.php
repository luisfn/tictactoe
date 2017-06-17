<?php

namespace TicTacToe\Player;

/**
 * Class Player
 * @package TicTacToe\Player
 */
abstract class Player implements PlayerInterface
{

    const HUMAN = 'human';
    const BOT = 'bot';

    /**
     * @var
     */
    protected $type;

    /**
     * @var
     */
    protected $symbol;

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