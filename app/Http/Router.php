<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router
{
    /**
     * URL completa do projeto (raiz)
     * @var string 
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas 
     * @var string  
     */
    private $prefix = '';

    /**
     * Indice de rotas
     * @var array
     */
    private $routes = [];

    /**
     *  Instancia de request
     * @var Request
     */
    private $request;

    /**
     * Método responsável por iniciar a classe
     */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
    }

    /**
     * Método responsavel por definir o prefixo das rotas 
     */
    public function setPrefix()
    {
        //INFORMAÇÕES DA URL ATUAL
        $parseUrl = parse_url($this->url);

        //DEFINE O PREFIXO
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método responsável por adicionar uma rota na classe
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method, $route, $params)
    {
        //VALIDAÇÃO DOS PARAMS
        foreach($params as $key=>$value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
            }
        }

        //PADRÃO DE VALIDAÇÃO DA URL
        $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';

        //ADD A ROTA DENTRO DA CLASSE
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método responsavel por defirnir uma rota de get 
     * @param string $route
     * @param array $params
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * Método responsável por executar a rota atual
     * @return Response
     */
    public function run(){
        try{
            throw new Exception("Página não encontrada", 404);
        }catch(Exception $e){
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
