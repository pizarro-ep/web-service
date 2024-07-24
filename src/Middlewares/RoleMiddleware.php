<?php
namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RoleMiddleware
{
    private $allowedRoles;

    public function __construct($allowedRoles)
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $token = $request->getAttribute('token');
        $userRoles = $token->roles ?? [];

        // Verificar si el usuario tiene al menos uno de los roles permitidos
        $isAuthorized = false;
        foreach ($this->allowedRoles as $allowedRole) {
            if (in_array($allowedRole, $userRoles)) {
                $isAuthorized = true;
                break;
            }
        }

        if (!$isAuthorized) {
            $response->withStatus(403)->getBody()->write(json_encode(['error' => 'No tienes permiso para acceder a esta ruta']));
        }

        $response = $next($request, $response);
        return $response;
    }
}
