<?php
//echo "<pre>"; print_r($keys); echo "</pre>"; exit;
namespace App\Http;

class Response {
    //Codigo do Status HTTP
    private $httpCode = 200;
    // Cabeçalho do Response
    private $headers = [];
    //Tipo de Conteudo que esta sendo retornado
    private $contentType = 'text/html';
    //Guardar o conteudo do Response
    private $content;
    //Metodo responsavel por iniciar a classe e definir os valores
    public function __construct($httpCode, $content, $contentType = 'text/html'){
        $this->httpCode = $httpCode;
        $this->content= $content;
        $this->setContentType($contentType);
    }
    //Metodo responsavel por alterar o ContentType do Response
    public function setContentType($contentType){
        $this->contentType= $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
    //Metodo responsavel por enviar os Headers para o navegador
    private function sendHeaders(){
        //DEfine status
        http_response_code($this->httpCode);
        //Enviar Headers
        foreach($this->headers as $key=>$value){
            header($key.': '.$value);
        }

    }
    //Metodo responsavel por adcionar um registro no cabeçalho do Response
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }
    //Metodo responsavel por enviar a resposta para o usuario
    public function sendResponse(){
        //Envia os Headers
        $this->sendHeaders();
        //Imprimir conteudo
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}


?>