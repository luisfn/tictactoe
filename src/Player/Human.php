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
    protected $controlledBy = Player::HUMAN;

    /**
     * @var string
     */
    protected $symbol = 'X';

    /**
     * Human constructor.
     */
    public function __construct()
    {
        parent::__construct($this->symbol, $this->controlledBy);
    }
}