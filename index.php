<?php

require 'vendor/autoload.php';

use Philo\Blade\Blade;
use TicTacToe\Controllers\GameController;
use TicTacToe\Game\TicTacToe;

session_start();

$config = require_once 'config/config.php';

// Container
$container = new League\Container\Container;

$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->share('blade', new Blade($config['views'], $config['cache']));
$container->share('tictactoe', new TicTacToe());
$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

// Routes
$route = new League\Route\RouteCollection($container);
$route->get('/', [new GameController($container), 'index']);
$route->get('/getNextMove', [new GameController($container), 'getNextMove']);
$route->get('/reset', [new GameController($container), 'reset']);

$response = $route->dispatch($container->get('request'), $container->get('response'));
$container->get('emitter')->emit($response);
