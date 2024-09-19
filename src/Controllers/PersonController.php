<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Services\PersonService;
use Slim\Views\Twig;

/**
 * Clase PersonController
 * Controlador de operaciones de manipulación de personas
 */
class PersonController
{
    /**  @var PersonService $personService El servicio responsable de las operaciones relacionadas con las personas. */
    private $personService;

    /** Constructor de la clase PersonController  */
    public function __construct()
    {
        $this->personService = new PersonService();
    }

    /**
     * Método del controlador que sirve para mostrar la vista
     * @param ServerRequestInterface $request El objeto de solicitud HTTP
     * @param ResponseInterface $response El objeto de respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return ResponseInterface La respuesta HTTP
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        try {
            $view = Twig::fromRequest($request);
            $data = $this->personService->index();
            return $view->render($response, 'home.twig', $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Método del controlador que sirve para obtener los datos de la(s) persona(s)
     * @param ServerRequestInterface $request El objeto de la solicitud HTTP
     * @param ResponseInterface $response El objeto de respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return ResponseInterface La respuesta HTTP
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        try {
            $result = $this->personService->show($request, $response, $args);
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Método del controlador que sirve para crear los datos de nuevas personas o actulizar existentes
     * @param ServerRequestInterface $request El objeto de la solicitud HTTP
     * @param ResponseInterface $response El objeto de la respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return ResponseInterface La respuesta HTTP
     */
    public function insert(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        try {
            $result = $this->personService->insert($request, $response, $args);
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Método del controlador que sirve para eliminar persona(s)
     * @param ServerRequestInterface $request El objeto de la solicitud HTTP
     * @param ResponseInterface $response El objeto de la respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return ResponseInterface La respuesta HTTP
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        try {
            $result = $this->personService->delete($request, $response, $args);
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
