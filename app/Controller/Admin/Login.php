<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Login extends Page
{
    /**
     * Método responsável por retornar a renderização da pagina de login 
     * @param Request $request
     * @return string 
     */
    public static function getLogin($request)
    {
        //CONTEUDO DA PAGINA DE LOGIN 
        $content = View::render('admin/login', []);

        //RETORNA A PAGINA COMPLETA
        return parent::getPage('Login - title', $content);
    }
}
