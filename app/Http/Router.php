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
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
            }
        }

        //PADRÃO DE VALIDAÇÃO DA URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

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
     * Método responsável por retornar a URI sem o prefixo 
     * @return string
     */

    private function getUri()
    {
        //URI DA REQUEST
        $uri = $this->request->getUri();

        //FATIA A URI COM O PREFIXO
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        //RETORNA A URI SEM PREFIXO 
        return end($xUri);
    }

    /**
     * Método responsável por retornar os dados da rota atua
     * @return array
     */
    private function getRoute()
    {
        //URI
        $uri = $this->getUri();

        //METHOD
        $httpMethod = $this->request->getHttpMethod();

        //VALIDA AS ROTAS
        foreach ($this->routes as $patternRoute => $methods) {
            //VERIFICA SE A ROTA BATE COM O PADRÃO
            if (preg_match($patternRoute, $uri)) {
                //VERIFICA O MÉTODO
                if ($methods[$httpMethod]) {
                    return $methods[$httpMethod];
                }
                //MÉTODO NÃO PERMITIDO DEFINIDO 
                throw new Exception("Método não permitido!", 405);
            }
        }
        throw new Exception("URL não encontrada!", 404);
    }

    /**
     * Método responsável por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {
            //OBTEM A ROTA ATUAL
            $route = $this->getRoute();
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
