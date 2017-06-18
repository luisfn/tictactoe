<?php

namespace TicTacToe\Controllers;

use League\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TicTacToe\Player\Bot;

class GameController
{
    /**
     * @var ContainerInterface
     */
    private $view;

    /**
     * GameController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get('blade')->view();
        $this->ticTacToe = $container->get('tictactoe');
    }

    /**
     * Renders game board initial state
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write($this->view->make('index')->render());
        return $response;
    }

    /**
     * Requests a new move
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function getNextMove(ServerRequestInterface $request, ResponseInterface $response)
    {
        $pos = $this->ticTacToe->getRandomFreePosition();
        $bot = new Bot();

        $this->ticTacToe->makeMove($pos[0], $pos[1], $bot);

        $response->getBody()->write(json_encode($this->ticTacToe->getGameState()));
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function reset(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->ticTacToe->resetGameState();

        return $response;
    }

}