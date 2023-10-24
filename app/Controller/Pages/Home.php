<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Controller\Pages;
use \App\Utils\View;
use \App\Model\Entity\Organization;


class Home extends Page{
    //Metodo responsavel por retorno o conteudo da nossa home (view)
    public static function getHome(){
        //Organização
        $obOrganization = new Organization;
        //View da Home
        $content = View::render('pages/home',[
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
            'site' => $obOrganization->site
        ]);
        // Retorna a View da Pagina
        return parent::getPage('Leonardo Laurindo - MVC', $content);
    }

}