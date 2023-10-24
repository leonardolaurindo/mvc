<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Http;

class Request{
    //Metodo HTTP da Requisição
    private $httpMethod;
    //URI da Pagina = Rota
    private $uri;
    //Parametros da URL ($_GET)
    private $queryParams;
    // Variaveis Recebidas no Post
    private $postVars = [];
    // Cabeçalho da Requisição
    private $headers = [];
    // Contrutor da classe
    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? [];
        $this->uri = $_SERVER['REQUEST_URI'] ?? [];
    }
    //Metodo responsavel por retornar o Metodo HTTP da Reqiusição
    public function getHttpMethod(){
        return $this->httpMethod;
    }
    //Metodo responsavel por retornar a URI da Reqiusição
    public function getUri(){
        return $this->uri;
    }
    //Metodo responsavel por retornar os Headers da Reqiusição
    public function getHeaders(){
        return $this->headers;
    }
      //Metodo responsavel por retornar os parametros da URL da Reqiusição
      public function getQueryParams(){
        return $this->queryParams;
    }
      //Metodo responsavel por retornar as Variaveis POST da Reqiusição
      public function getPostVars(){
        return $this->postVars;
    }
}


?>