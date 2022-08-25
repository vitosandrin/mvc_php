<?php

namespace App\Controller\Pages;
/* Use View */
use \App\Utils\View;
/* Use BD */
use \App\Model\Entity\Organization;

/* Home extends para Page dinâmica */
class Home extends Page
{
    /* Controller resposável por retornar a view Home */
    public static function getHome()
    {
        $obOrganization = new Organization;

        //View Home
        $content = View::render('pages/home', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description
        ]);
        return parent::getPage('HomePage ', $content);
    }
}
