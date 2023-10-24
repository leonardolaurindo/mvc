<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Http;
use \Closure;
use \Exception;

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
        //Padrão de Validação da URL
        $patternRoute = '/^'.str_replace('/','\/', $route).'$/';
        //Adiciona a Rota dentro da Classe
        $this->routes[$patternRoute][$method]=$params;
        
    }
    //Metodo responsavel por definir uma Rota de GET
    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }
     //Metodo responsavel por definir uma Rota de POST
     public function post($route, $params = []){
        return $this->addRoute('POST', $route, $params);
    }
     //Metodo responsavel por definir uma Rota de PUT
     public function put($route, $params = []){
        return $this->addRoute('PUT', $route, $params);
    }
     //Metodo responsavel por definir uma Rota de DELETE
     public function delete($route, $params = []){
        return $this->addRoute('DELETE', $route, $params);
    }
    //retorna a URI sem o Prefixo
    private function getUri(){
        //Pega URI da Request
        $uri = $this->request->getUri();
        
        //Fatia a URI com o Prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        
        //Retorna a URI sem Prefixo
        return end($xUri);
        
    }
    //Metodo responsavel por retornar os dados da rota atual
    private function getRoute(){
        //URI
        $uri = $this->getUri();
        
        //Method
        $httpMethod = $this->request->getHttpMethod();
        
        //Valida as Rotas
        foreach($this->routes as $patternRoute=>$methods){
            
            //Verifica se a URI bate o Padrão
            if(preg_match($patternRoute, $uri)){ 
                //asdas
                //Verifica o Metodo
                if($methods[$httpMethod]){
                    //Retorno dos Parametros da Rota
                    return $methods[$httpMethod];
                }
                //Metodo não permitido/definido
                throw new Exception("Método não permitido", 405);
            }
        }
        //URL não encontrada
        throw new Exception("URL Não encontrada", 404);
        
    }
    //Metodo responsavel por executar a Rota Atual
    public function run(){
        try{
            //Obtem a Rota Atual
            $route = $this->getRoute();
            echo "<pre>"; print_r($route); echo "</pre>"; exit;
            //Verifica o Controllador
            if(!isset($route['controller'])){
                throw new Exception("A Url Não pode ser processada", 500); 
            }
            //Argumentos da Função
            $args = [];
            //Retorna a Execução da Função
            return call_user_func_array($route['controller'], $args);

        }catch(Exception $e){
            return new Response($e->getCode(),$e->getMessage());
        }
    }
}


?>