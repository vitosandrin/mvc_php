<?php

namespace App\Controller\Pages;

/* Use View */
use \App\Utils\View;
/* Use BD */
use \App\Model\Entity\Organization;

/* Home extends para Page dinâmica */
class About extends Page
{
    /**
     * Controller responsavel por gerenciar req feitas na home
     * @return string 
     */
    public static function getAbout()
    {
        /* Executa o model para obter dados*/
        $obOrganization = new Organization;

        /* Pega os dados do model e passa o $content para page.php*/ 
        $content = View::render('pages/about', [
            /*{{name}} chave do array referenciada nos resources */
            'name' => $obOrganization->name,
            'description' => $obOrganization->description
        ]);
        return parent::getPage('AboutPage - title', $content);
    }
}
