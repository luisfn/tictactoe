<?php

require 'vendor/autoload.php';

use Philo\Blade\Blade;
use TicTacToe\Game\TicTacToe;
use TicTacToe\Player\Bot;
use TicTacToe\Player\Human;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$views = __DIR__ . '/resources/views';
$cache = __DIR__ . '/resources/cache';

/*$blade = new Blade($views, $cache);

$ttt = new TicTacToe();
$human = new Human();
$bot   = new Bot();

$ttt->makeMove(0,0, $human);
$ttt->makeMove(1,1, $human);
$ttt->makeMove(2,2, $human);

$ttt->makeMove(0,2, $bot);
$ttt->makeMove(0,1, $bot);
$ttt->makeMove(2,0, $bot);

echo $blade->view()->make('board', ['board' => $ttt->getGameState()])->render();*/

$container = new League\Container\Container;

$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

$route = new League\Route\RouteCollection($container);

$route->map('GET', '/', function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

$route->map('GET', '/test', function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write('<h1>Route B</h1>');
    return $response;
});


$response = $route->dispatch($container->get('request'), $container->get('response'));

$container->get('emitter')->emit($response);


