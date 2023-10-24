<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Controller\Pages;
use \App\Model\Entity\Organization;
use App\Utils\View;

class Page{
    //Metodo responsavel por renderizar o topo da pagina
    private static function getHeader(){
        return View::render('pages/header');
    }
    //Metodo responsavel por renderizar o footer da pagina
    private static function getFooter(){
        return View::render('pages/footer');
    }
    //Metodo responsavel por retorno o conteudo da nossa pagina genérica (view)
    public static function getPage($title, $content){
        return View::render('pages/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

}