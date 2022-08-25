<?php

namespace App\Http;

class Response
{
    /**
     * Código do status HTTP
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do response
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteudo retornado
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteúdo do response
     * @var mixed
     */
    private $content;

    /**
     * Método responsável por iniciar a classe e definir os valores 
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType = ($contentType);
    }
    /**
     * Método responsável por alterar o contentType do response
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        /*                $key                 */
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Método responsável por adicionar um registro no cabeçalho de response 
     * @param array $key
     * @param string $value 
     */
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }
    /**
     * Método responsável por enviar os headers para o navegador 
     */
    private function sendHeaders(){
        //STATUS
        http_response_code($this->httpCode);

        //ENVIAR HEADERS
        foreach($this->headers as $key=>$value){
            header($key.': '.$value);
        }
    }

    /**
     * Método responsavel por Enviar a reposta para o user
     * 
     */
    public function sendResponse(){
        //Envia os headers
        $this->sendHeaders();
        
        //Imprime o content
        switch($this->contentType){
            case 'text/html':
                echo $this->content;
            exit;
        }
    }
}
