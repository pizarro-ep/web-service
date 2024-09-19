<?php

namespace App\Models;

/**
 * Clase Modelo de usuario que maneja la manipulación de los datos y la lógica de la aplicación. 
 */
class UserModel
{
    // Atributos del usuario
    private $id;
    private $name;
    private $surname;
    private $email;
    private $birthdate;

    /**
     * Constructor para inicializar el modelo usuario
     */
    public function __construct($id = null, $name = null, $surname = null, $email = null, $birthdate = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->birthdate = $birthdate;
    }

    // Getters y setters

    /**
     * Obtiene el ID del usuario.
     * @return int El ID del usuario.
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Establece el ID del usuario.
     * @param int $id El ID del usuario.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Obtiene el ID del usuario.
     * @return string El ID del usuario.
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Establece el nombre del usuario.
     * @param string $name El nombre del usuario.
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Obtiene el apellidos del usuario.
     * @return string El apellidos del usuario.
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * Establece los apellidos del usuario.
     * @param string $surname El apellidos del usuario.
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * Obtiene el email del usuario 
     * @return string El correo del usuario
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Establece el email del usuario 
     * @param string $email El email del usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Obtiene el cumpleaño del usuario
     * @return string|null El cumpleaños del usuario
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    /**
     * Establece el cumpleaños del usuario.
     * @param string $birthdate El cumpleaños del usuario.
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
}
?>
