<?php
require __DIR__.'/includes/app.php';
use \App\Http\Router;

$obRouter = new Router(URL);

include __DIR__ . '/routes/pages.php';

//IMPRIME O RESPONSE DA ROTA 
$obRouter->run()->sendResponse();
