<?php

use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

class MyTest extends TestCase
{
    protected $app;

    public function setUp(): void
    {
        // Configura una instancia de la aplicación Slim para cada prueba
        $this->app = AppFactory::create();

        $this->app->get('/api/show',  'App\Controllers\PersonController:show');
        $this->app->get('/api/show/{id}',  'App\Controllers\PersonController:show');
        $this->app->post('/api/create', 'App\Controllers\PersonController:insert');
        $this->app->put('/api/update/{id}', 'App\Controllers\PersonController:insert');
        $this->app->delete('/api/delete/{id}', 'App\Controllers\PersonController:delete');
        $this->app->get('/api/user/show', 'App\Controllers\UserController:show');
    }


    public function testMethodGet1()
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', "/api/show?name=Zero&age=18");
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Retorna un arreglo bidimencional con consulta condicional', (string)$response->getBody(), "Mostrar datos");
    }
    public function testMethodGet2()
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', "/api/show/1");
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Retorna un arreglo bidimencional con consulta simple', (string)$response->getBody(), "Mostrar datos");
    }
    public function testMethodPost()
    {
        $data = ['name' => 'Ejemplo', 'age' => 25];
        $request = (new ServerRequestFactory())->createServerRequest('POST', '/api/create')->withHeader('Content-Type', 'application/json')->withParsedBody($data);
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Se ha insertado correctamente', (string)$response->getBody(), "Crear datos");
    }
    public function testMethodPut()
    {
        $data = ['name' => 'Ejemplo', 'age' => 25];
        $request = (new ServerRequestFactory())->createServerRequest('PUT', '/api/update/1')->withHeader('Content-Type', 'application/json')->withParsedBody($data);
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Se ha actualizado correctamente', (string)$response->getBody(), "Actualizar datos");
    }
    public function testMethodDelete()
    {
        $request = (new ServerRequestFactory())->createServerRequest('DELETE', '/api/delete/1');
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Se ha eliminado correctamente', (string)$response->getBody(), "Eliminar datos");
    }

    public function testGetUser()
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/api/user/show');
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Retorna usuarios', (string)$response->getBody(), "");
    }
}
