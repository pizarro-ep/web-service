<?php
namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;
use Exception;

class JwtMiddleware
{
    private $secret;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $authorizationHeader = $request->getHeaderLine('Authorization');
        if (empty($authorizationHeader)) {
            return $response->withStatus(401)->getBody()->write(json_encode(['error' => 'Token no proporcionado']));
        }

        // Verificar el token JWT
        $token = str_replace('Bearer ', '', $authorizationHeader);
        try {
            $decoded = JWT::decode($token, $this->secret, ['HS256']);
            // Puedes agregar la información del usuario decodificado al request para usarla en las rutas protegidas
            $request = $request->withAttribute('token', $decoded);
        } catch (Exception $e) {
            return $response->withStatus(401)->getBody()->write(json_encode(['error' => 'Token inválido']));
        }

        $response = $next($request, $response);
        return $response;
    }
}
