<?php
require __DIR__ . '/vendor/autoload.php';

use \App\Controller\Pages\Home;
use \App\Http\Router;
use \App\Http\Response;

define('URL', 'http://localhost/mvcphp');

$obRouter = new Router(URL);
//ROTA HOME
$obRouter->get('/', [
    function () {
        return new Response(200, Home::getHome());
    }
]);


//IMPRIME O RESPONSE DA ROTA 
$obRouter->run()->sendResponse();
