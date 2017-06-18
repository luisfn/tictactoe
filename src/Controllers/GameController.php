<?php

namespace TicTacToe\Controllers;

use League\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TicTacToe\Player\Human;

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
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function reset(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->ticTacToe->resetGameState();

        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function getGameState(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write(json_encode($this->ticTacToe->getGameState()));

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

        $response->getBody()->write(json_encode($pos));
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function makeMove(ServerRequestInterface $request, ResponseInterface $response)
    {
        $pos = json_decode($request->getBody()->getContents(), true);
        $human = new Human();

        $this->ticTacToe->makeMove($pos['x'], $pos['y'], $human);

        return $response;
    }

}