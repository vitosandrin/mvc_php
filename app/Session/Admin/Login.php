<?php

namespace App\Session\Admin;

use \App\Model\Entity\User;

class Login
{

    /**
     * Método responsavel por iniciar a sessão
     */
    private static function init()
    {
        //VERIFICA SE A SESSÃO NÃO ESTÁ ATIVA 
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Método responsável por criar o login do usuario 
     * @param User
     * @return boolean
     */
    public static function login($obUser)
    {
        //INICIA A SESSÃO
        self::init();

        $_SESSION['admin']['usuario'] = [
            'id' => $obUser->id,
            'nome' => $obUser->nome,
            'email' => $obUser->email
        ];
        return true;
    }
    /**
     * Método responsavel por verificar se o user esta logado
     * @return boolean
     */
    public static function isLogged()
    {
        //INICIA A SESSÃO
        self::init();

        //RETORNA A VERIFICAÇÃO
        return isset($_SESSION['admin']['usuario']['id']);
    }

    /**
     * Método responsável por executar o logout do user 
     * @return boolean
     */
    public static function logout()
    {
        //INICIA A SESSÃO
        self::init();

        //RETORNA A VERIFICAÇÃO
        unset($_SESSION['admin']['usuario']);

        //SUCESSO
        return true;
    }
}
