<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

class AuthController {
    private $secret = "zero_ep";

    public function getToken(Request $request, Response $response, $args) {
        //$parsedBody = $request->getParsedBody();
        //$username = $parsedBody['username'];
        //$password = $parsedBody['password'];

        $username = "user";
        $password = "pass";

        echo ($username);
        
        if("user" == $username && "pass" == $password){
            // Simulación: si la autenticación es exitosa, se genera y devuelve un token JWT
            $token = JWT::encode(['username' => $username], $this->secret, "HS256");
    
            // Devolver el token como respuesta
            $response->getBody()->write(json_encode(['token' => $token]));
            return $response->withHeader('Content-Type', 'application/json');
        }
        return $response->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['message' => 'Ocurrió un error']));
    }
}
