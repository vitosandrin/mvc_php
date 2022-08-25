<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home
{
    /* Controller resposável por retornar a view Home */
    public static function getHome()
    {
        return View::render('pages/home', [
            'name' => 'Vito Sandrin',
            'description' => 'isso é um teste'
        ]);
    }
}
