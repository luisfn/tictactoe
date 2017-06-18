<?php

namespace TicTacToe\Player;

use JsonSerializable;

/**
 * Class Player
 * @package TicTacToe\Player
 */
abstract class Player implements PlayerInterface, JsonSerializable
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

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'type' => $this->type,
            'symbol' => $this->symbol,
        ];
    }
}