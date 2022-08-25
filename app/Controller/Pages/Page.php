<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{
    /**
     * Controller render header
     * @return string
     */
    
    private static function getHeader()
    {
        return View::render('pages/header');
    }
    /**
     * Controller render footer
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/footer');
    }
    /**
     * Controller resposável por retornar a view Page (generica)
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            //'<nome da chave>'
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}
