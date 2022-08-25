<?php
require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost/mvcphp');

//DEFINE O VALOR PADRÃO DAS VARIAVEIS 
View::init([
    'URL' => URL
]);

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

//IMPRIME O RESPONSE DA ROTA 
$obRouter->run()->sendResponse();
