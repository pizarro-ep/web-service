<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\UserService;

class UserController {
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request, Response $response, $args){
        return $response->getBody()->write('Llega aqui');
    }

    public function show(Request $request, Response $response, $args){
        try {
            $result = $this->userService->show($request, $response, $args);
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAllUsers(Request $request, Response $response, $args) {
        $users = $this->userService->getAllUsers();
        if($users){
            $response->getBody()->write(json_encode($users));
            return $response->withHeader('Content-Type', 'application/json');
        }
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'No hay usuario para mostrar']));
    }

    public function getUser(Request $request, Response $response, $args) {
        $userId = $args['id'];
        $user = $this->userService->getUserById($userId);

        if($user){
            $response->getBody()->write(json_encode($user));
            return $response->withHeader('Content-Type', 'application/json');
        }
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Usuario no encontrado']));
    }

    public function createUser(Request $request, Response $response, $args) {
        $data = $args;
        if($data){
            $result = $this->userService->insertUser($data);
            if($result){
                return $response->getBody()->write("Se registró el nuevo usuario correctamente");
            }else{
                return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Oucrrió un error al realizar inserción de nuevos datos de l usuario']));
            }
        }
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Ocurrió un error en la petición']));
    }

    public function updateUser(Request $request, Response $response, $args) {
        $userId = $args['id'];
        unset($args['id']);
        $data = $args;
        if($data){
            $result = $this->userService->insertUser($data, $userId);
            if($result){
                return $response->getBody()->write("Usuario con id: $userId eliminado correctamente");
            }else{
                return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Ocurrió un error al realizar la actualización de los datos del usuario']));
            }
        }
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Ocurrió un error en la petición']));
    }

    public function deleteUser(Request $request, Response $response, $args) {
        $userId = $args['id'];
        if($userId){
            $result = $this->userService->deleteUser($userId);
            if($result){
                return $response->getBody()->write("Usuario con id: $userId eliminado correctamente");
            }else{
                return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Ocurrió un error al realizar la eliminación del usuario']));
            }
        }
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Ocurrió un error en la petición']));
    }
}
