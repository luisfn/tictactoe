<?php

namespace TicTacToe\Player;

/**
 * Class Human
 * @package TicTacToe\Player
 */
class Bot extends Player
{
    /**
     * @var string
     */
    protected $controlledBy = Player::BOT;

    /**
     * @var string
     */
    protected $symbol = 'O';

    /**
     * Human constructor.
     */
    public function __construct()
    {
        parent::__construct($this->symbol, $this->controlledBy);
    }
}