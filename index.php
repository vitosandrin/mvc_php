<?php 
    require __DIR__.'/vendor/autoload.php';
    echo "Hello World";

    use \App\Controller\Pages\Home;
    
    echo Home::getHome();
