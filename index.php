<?php

require 'vendor/autoload.php';

use Philo\Blade\Blade;
use TicTacToe\Game\TicTacToe;
use TicTacToe\Player\Bot;
use TicTacToe\Player\Human;

$views = __DIR__ . '/resources/views';
$cache = __DIR__ . '/resources/cache';

$blade = new Blade($views, $cache);

$ttt = new TicTacToe();
$human = new Human();
$bot   = new Bot();

$ttt->makeMove(0,0, $human);
$ttt->makeMove(1,1, $human);
$ttt->makeMove(2,2, $human);

$ttt->makeMove(0,2, $bot);
$ttt->makeMove(0,1, $bot);
$ttt->makeMove(2,0, $bot);





echo $blade->view()->make('board', ['board' => $ttt->getGameState()])->render();