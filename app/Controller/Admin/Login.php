<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;
use \App\Session\Admin\Login as SessionAdminLogin;


class Login extends Page
{
    /**
     * Método responsável por retornar a renderização da pagina de login 
     * @param Request $request
     * @param string $errorMessage
     * @return string 
     */
    public static function getLogin($request, $errorMessage = null)
    {
        //STATUS DO LOGIN
        $status = !is_null($errorMessage) ? View::render('admin/login/status', [
            'mensagem' => $errorMessage,
        ]) : '';

        //CONTEUDO DA PAGINA DE LOGIN 
        $content = View::render('admin/login', [
            'status' => $status,
        ]);

        //RETORNA A PAGINA COMPLETA
        return parent::getPage('Login - title', $content);
    }

    /**
     * Método responsável por definir o login do user 
     * @param Request $request
     */
    public static function setLogin($request)
    {
        //POST VARS
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        //BUSCA USER PELO EMAIL NO BANCO DE DADOS 
        $obUser = User::getUserByEmail($email);
        if (!$obUser instanceof User) {
            return self::getLogin($request, 'E-mail ou senha inválido!');
        }

        //VERIFICA A SENHA DO USER
        if (!password_verify($senha, $obUser->senha)) {
            return self::getLogin($request, 'E-mail ou senha inválido!');
        }

        //CRIA A SESSÃO DE LOGIN
        SessionAdminLogin::login($obUser);
        //REDIRECIONA O USER PARA A HOME DO ADMIN
        $request->getRouter()->redirect('/admin');
    }

    /**
     * Método responsável por fazer o logout do user
     * @param Request $request 
     * @return boolean
     */
    public static function setLogout($request)
    {
        //DETRÓI A SESSÃO DE LOGIN
        SessionAdminLogin::logout();
        //REDIRECIONA O USER PARA A TELA DE LOGIN
        $request->getRouter()->redirect('/admin/login');
    }
}
