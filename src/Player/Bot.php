<?php

namespace TicTacToe\Player;

/**
 * Class Bot
 * @package TicTacToe\Player
 */
class Bot extends Player
{
    /**
     * @var string
     */
    protected $type = Player::BOT;

    /**
     * @var string
     */
    protected $symbol = 'O';

    /**
     * Bot constructor.
     */
    public function __construct()
    {
        parent::__construct($this->type, $this->symbol);
    }
}