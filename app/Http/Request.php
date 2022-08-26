<?php

namespace App\Http;

class Request
{
    /**
     * Instancia do Router 
     * @var Router
     */
    private $router;

    /**
     * Método HTTP para criar a requisição
     * @var string 
     */
    private $httpMethod;

    /**
     * URI / rota  da página
     * @var string 
     */
    private $uri;

    /**
     * Parametros da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Váriaveis recebidas no POST da pagina 
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    /**
     * Contrutor da classe
     */
    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }
    /**
     * Método responsavel por definir a URI
     */
    private function setUri()
    {
        //URI COMPLETA (COM GETS)
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

        //REMOVE GETS DA URI
        $xURI = explode('?', $this->uri);
        $this->uri = $xURI[0];
    }
    /**
     * Método responsável por retornar a instancia de router
     * @return Router
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Método responsável por retornar o método HTTP da req
     * @return string 
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Método responsável por retornar a URI da req
     * @return string 
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Método responsável por retornar os headers da req
     * @return array 
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Método responsável por retornar os parametros da url da  req
     * @return array 
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Método responsável por retornar os headers da req
     * @return array 
     */
    public function getPostVars()
    {
        return $this->postVars;
    }
}
