<?php

use \App\Http\Response;
use \App\Controller\Admin;


//ROTA ADMIN
$obRouter->get('/admin', [
    function () {
        return new Response(200, 'Admin');
    }
]);

//ROTA LOGIN
$obRouter->get('/admin/login', [
    function ($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);
