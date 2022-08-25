<?php

namespace App\Http;

class Request
{
    /**
     * Método HTTP da requisição
     * @var string 
     */
    private $httpMethod;

    /**
     * URI da página
     * @var string 
     */
    private $uri;

    /**
     * Parametros da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Várivaeis recebidas no POST da pagina 
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Método responsável por retornar o método HTTP da req
     * @return string 
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }

    /**
     * Método responsável por retornar a URI da req
     * @return string 
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * Método responsável por retornar os headers da req
     * @return array 
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Método responsável por retornar os parametros da url da  req
     * @return array 
     */
    public function getQueryParams(){
        return $this->queryParams;
    }

    /**
     * Método responsável por retornar os headers da req
     * @return array 
     */
    public function getPostVars(){
        return $this->postVars;
    }
}
