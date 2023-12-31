<?php
//"<pre>"; print_r($obRequest); echo "</pre>"; exit;

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use App\Http\Response;
use \App\Controller\Pages\Home;


define('URL','http://localhost/mvc');

$obRouter = new Router(URL);
//Definir Rota HOME
$obRouter->post('/',[
    function(){
        return new Response(200,Home::getHome());
    }
]);
//Definir Rota HOME

//Imprime o Response da Rota
$obRouter->run()->sendResponse();


?>