<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Utils;

class View{
    // Metodo responsavle por retornar o conteudo de uma View
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }
    
    // Metodo repsonsavel por retornar o conteudo rendereizado de uma View
    public static function render($view, $vars = []){
        //Conteudo da View
        $contentView = self::getContentView($view);
        //Descobrir chaves do Array de Variaveis
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);


        //retorno o conteudo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }


}



?>