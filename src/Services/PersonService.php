<?php

namespace App\Services;

use App\Core\DataBase;

/**
 * Clase PersonService
 * Clase que realiza la lógica para la manipulación de los datos de Persona(s)
 */
class PersonService
{
    /** @var DataBase $db Variable para instanciar la conexión a la base de datos */
    protected $db;
    /** @var $table Variable para definir la tabla de la base de datos*/
    private $table = "adm_persons";

    /** Constructor de la clase PersonService */
    public function __construct()
    {
        // $this->db = DataBase::getInstance();
    }

    /**
     * Método para mostrar datos en la ventana principal de personas
     * @return array datos para la vista personas
     */
    public function index()
    {
        return ["name" => "ZERO"];
    }

    /**
     * Método para obtener los datos de las personas
     * @param mixed $request Objeto de la solicitud HTTP
     * @param mixed $response Objeto de la respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return array Retorna el arreglo de datos obtenidos de la DB
     */
    public function show($request, $response, $args)
    {
        $queryParams = $request->getQueryParams() ?? [];            // params?par1=abc&par2=xyz
        $id = $args['id'] ?? null;                                  // page/1

        if ($id)
            return ["name" => "Pedro", "address" => "Zorritos 1223", "id" => $id];
        elseif ($queryParams) {
            return ["message" => "Retorna un arreglo bidimensional con consulta condicional", "params" => $queryParams];
        } else {
            return ["message" => "Retorna un areglo bidimensional con consulta simple"];
        }
    }

    /**
     * Método para crear o actualizar datos de la persona
     * - Se actualiza si existe $args['id']
     * - Se crea si no existe $args['id']
     * @param mixed $request Objeto de la solicitud HTTP
     * @param mixed $response Objeto de la respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return array Retorna el estado de consulta
     */
    public function insert($request, $response, $args)
    {
        $data = $request->getParsedBody() ?? [];                    // body data
        $id = $args['id'];
        if ($data) {
            if ($id) {
                return ["message" => "Se ha actualizado correctamente", "id" => $id, "data" => $data];
            } else {
                return ["message" => "Se ha insertado correctamente", "data" => $data];
            }
        } else {
            return ["message" => "Faltan datos"];
        }
    }

    /**
     * Método para eliminar datos de la persona
     * @param mixed $request Objeto de la solicitud HTTP
     * @param mixed $response Objeto de la respuesta HTTP
     * @param array $args Argumentos opcionales
     * @return array Retorna el estado de la consulta
     */
    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        return ["message" => "Se ha eliminado correctamente", "id" => $id];
    }
}
