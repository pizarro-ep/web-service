<?php
use App\Auth\Auth;
use App\Controllers\PersonController;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\Twig;

$app->get('/', function ($request, $response) {
    $view = Twig::fromRequest($request);    
    return $view->render($response, 'home.twig', [
        'name' => 'John',
    ]);
});

$app->get('/v1', function ($request, $response, $args) {
    $token = $request->getHeader('Authorization');
    $token = "token";
    $auth = new Auth(SECRET_KEY);
    if (!($auth->verifyToken($token))) {
        return $response->withStatus(401);
    }
});

// vistas
$app->group('/view', function(RouteCollectorProxy $group){
    $group->get('/persons', PersonController::class . ':index');
    $group->get('/user', PersonController::class . ':index');
    $group->get('/cousers', PersonController::class . ':index');
    $group->get('/other', PersonController::class . ':index');
});

// peticiones
$app->group('/api/v1', function(RouteCollectorProxy $group){
    $group->group('/persons', function(RouteCollectorProxy $persons){
        $persons->get('', PersonController::class . ':show');
        $persons->get('/{id}', PersonController::class . ':show');
        $persons->post('/create', PersonController::class . ':insert');
        $persons->put('/update/{id}', PersonController::class . ':insert');
        $persons->delete('/delete/{id}', PersonController::class . ':delete');
    });
    $group->group('/users', function(RouteCollectorProxy $persons){
        $persons->get('', PersonController::class . ':show');
        $persons->get('/{id}', PersonController::class . ':show');
        $persons->post('/create', PersonController::class . ':insert');
        $persons->put('/update/{id}', PersonController::class . ':insert');
        $persons->delete('/delete/{id}', PersonController::class . ':delete');
    });
    $group->group('/other', function(RouteCollectorProxy $persons){
        $persons->get('', 'App\Controllers\PersonController:show');
        $persons->get('/{id}', 'App\Controllers\PersonController:show');
        $persons->post('/create', 'App\Controllers\PersonController:insert');
        $persons->put('/update/{id}', 'App\Controllers\PersonController:insert');
        $persons->delete('/delete/{id}', 'App\Controllers\PersonController:delete');
    });
}); //->add(new JwtMiddleware(SECRET_KEY))->add(new RoleMiddleware(['admin']));
