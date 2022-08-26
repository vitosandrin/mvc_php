<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User
{
    /**
     * ID do user
     * @var integer
     */
    public $id;
    
    /**
     * Nome do user  
     * @var string
     */
    public $nome;

    /**
     * E-mail do usuario 
     * @var string 
     */
    public $email;

    /**
     * Senha do usuario
     * @var string
     */
    public $senha;
    
    /**
     * Método responsável por retornar um user com base no email
     * @param string
     * @return User
     */
    public static function getUserByEmail ($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

}
