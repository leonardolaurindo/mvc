<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Http;
use \Closure;

class Router{
    //URL Completa do Projeto - Raiz
    private $url = '';
    //Prefixo de Todas as Rotas
    private $prefix = '';
    //Indice de Rotas
    private $routes = [];
    //Instancia de Request
    private $request;
    //Metodo responsavel por iniciar a Classe
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }
    //Metodo responsavel por definir o prefixo dsa rotas
    private function setPrefix(){
        //Informações da URL
        $parseUrl = parse_url($this->url);
        //Define o Prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    }
    //Metodo reponsavel por adicionar uma rota na Classe -> Routes
    private function addRoute($method, $route, $params = []){
        //Validação dos Parametros
        foreach($params as $keys=>$value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$keys]);
                continue;
            }
        }
        
        echo "<pre>"; print_r($params); echo "</pre>"; exit;
    }
    //Metodo responsavel por definir uma Rota de GET
    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }
}


?>