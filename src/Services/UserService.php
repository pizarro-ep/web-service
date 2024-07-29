<?php

namespace App\Services;

use App\Core\DataBase;
use App\Models\UserModel;

/**
 * Clase de servicios del empleado, aqui se realizan las consultas a la base de datos.
 */
class UserService
{
    protected $db;
    private $table = "adm_users";

    public function __construct()
    {
        $this->db = DataBase::getInstance();
    }

    public function show($request, $response, $args){
        $connection = $this->db->getConnection();
        $query = "select * from test_users;";
        $result = $connection->query($query);
        $user = [];
        while ($row = $result->fetch_assoc()){
            $user = new UserModel();
            $user->setId($row['user_id']);
            $user->setName($row['user_name']);
            $user->setSurname($row['user_surname']);
            $user->setEmail($row['user_email']);
            $user->setBirthdate($row['user_birthdate']);
        }
        return $user;
    }

    /**
     * Obtiene todos los empleados de la base de datos.
     * @return array - Array de objetos UserModel o un array vacío si no hay empleados.
     */
    public function getAllUsers()
    {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM {$this->table}";
        $result = $connection->query($query);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $user = new UserModel();
            $user->setId($row['users_id']);
            $user->setName($row['users_name']);
            $user->setSurname($row['users_surname']);
            $user->setEmail($row['users_email']);
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Obtiene los datos del empleado según un ID especificado.
     * @param int $id - ID del empleado a buscar.
     * @return UserModel|null - Objeto UserModel si se encuentra, null si no se encuentra.
     */
    public function getUserById($id)
    {
        $connection = $this->db->getConnection();

        $query = "SELECT * FROM {$this->table} WHERE users_id = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new UserModel();
            $user->setId($row['users_id']);
            $user->setName($row['users_name']);
            $user->setSurname($row['users_surname']);
            $user->setEmail($row['users_email']);
            return $user;
        } else {
            return null;
        }
    }

    /**
     * Función que permite insertar y actualizar un registro
     * @param int $id - Id del empleado, si es nulo es un registro nuevo sino es actualizacion de un registro
     * @return bool - Retorna false si surge algun error, en caso contrario retorna true.
     */
    public function insertUser($data = [], $id = null)
    {
        $connection = $this->db->getConnection();

        if ($id) {
            $query = "UPDATE {$this->table} SET users_name = ?, users_surname = ?, users_email = ?, users_birthdate = ? WHERE users_id = ?";
            $statement = $connection->prepare($query);
            $statement->bind_param("ssssi", $data['name'], $data['surname'], $data['email'], $data['birthdate'], $id);
        } else {
            $query = "INSERT INTO {$this->table} (users_name, users_surname, users_email, users_birthdate) VALUES(?, ?, ?, ?)";
            $statement = $connection->prepare($query);
            $statement->bind_param("ssss", $data['name'], $data['surname'], $data['email'], $data['birthdate']);
        }

        if ($statement->execute()) {
            if (!$id) {
                $id = $statement->insert_id;
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * FUnción para eliminar empleados
     * @param int $id - Id del empleado a aliminar de la base de datos
     * @return bool - retorna falso si surge algún error en cas contrario retorna verdadero
     */
    public function deleteUser($id)
    {
        $connection = $this->db->getConnection();

        $query = "DELETE FROM {$this->table} WHERE users_id = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("i", $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

?>
