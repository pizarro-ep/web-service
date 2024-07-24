<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config.php';

$app = AppFactory::create();

// para las vistas
$twig = Twig::create(__DIR__ . '/../src/views', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

//manejo de errores
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$app->add(new App\Middlewares\ErrorMiddleware());
//$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

// Incluir las rutas definidas en src/routes.php
require __DIR__ . '/../src/routes.php';

$app->run();
