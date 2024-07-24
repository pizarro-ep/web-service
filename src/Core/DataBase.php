<?php

namespace App\Core;

use mysqli;

/**
 * Clase DataBase
 * Clase para realizar la conexión a la base de datos
 */
class DataBase
{
    private static $instance;
    private $connection;

    /** Constructor de la clase DataBase  */
    private function __construct()
    {
        // Cargar las variables de entorno
        require_once __DIR__ . '/../config.php';

        // Crear conexión
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar la conexión
        if ($this->connection->connect_error) {
            die('Ups, ocurrió un error al realizar la conexión: ' . $this->connection->connect_error);
        }
    }

    /**
     * Método para crear la instacia de la base de datos
     * @return $instance Retorna instancia estática
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Método para obtener la conexión a la base de datos
     * @return Connection Retorna la conexión a la base de datos
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Método para cerrar la conexión a la base de datos
     */
    public function closeConnection()
    {
        $this->connection->close();
    }
}
