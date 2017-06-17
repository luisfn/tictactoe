<?php

namespace TicTacToe\Player;

/**
 * Class Human
 * @package TicTacToe\Player
 */
class Human extends Player
{
    /**
     * @var string
     */
    protected $type = Player::HUMAN;

    /**
     * @var string
     */
    protected $symbol = 'X';

    /**
     * Human constructor.
     */
    public function __construct()
    {
        parent::__construct($this->type, $this->symbol);
    }
}