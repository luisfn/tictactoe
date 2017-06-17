<?php

namespace TicTacToe\Player;

interface PlayerInterface
{
    /**
     * Reteives player type
     * @return string
     */
    public function getType() : string;

    /**
     * Reteives player symbol
     * @return string
     */
    public function getSymbol() : string;

}