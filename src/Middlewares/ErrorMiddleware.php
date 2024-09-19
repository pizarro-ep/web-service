<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Throwable;

class ErrorMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        try {
            // Ejecutar el siguiente middleware o controlador
            return $handler->handle($request);
        } catch (Throwable $e) {
            // Manejar la excepción aquí
            $response = new \Slim\Psr7\Response();
            $response->getBody()->write('Error 500: Internal Server Error');
            return $response->withStatus(500);
        }
    }
}
