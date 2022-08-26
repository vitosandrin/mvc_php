<?php

namespace App\Http\Middleware;
use \Closure;

class Queue
{
    /**
     * Mapeamento de middlewares
     * @var array
     */
    private static $map = [];

    /**
     * Fila de middlewares a serem executados 
     * @var array
     */
    private $middlewares = [];

    /**
     * Função de execução do controlador 
     * @var Closure
     */
    private $controller;

    /**
     * Argumentos da função do controlador 
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Método responsável por contruir a classe de fila de middlewares 
     * @param array $middlewares 
     * @param Closure $controller 
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }
    /**
     * Método responsável por definir o mapeamento de middlewares 
     * @param array $map
     */
    public static function setMap($map)
    {
        self::$map = $map;
    }

    /**
     * Método responsável por executar o prox nivel da fila de middlewares
     * @param Request
     * @return Response
     */
    public function next($request)
    {
        //VERIFICA SE A FILA ESTÁ VAZIA
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        //MIDDLEWARE
        $middleware = array_shift($this->middlewares);

        //VERIFICA O MAPEAMENTO
        if (!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o middleware da Req.", 500);
        }

        //NEXT
        $queue = $this;
        $next = function($request) use($queue){
            return $queue->next($request);
        };

        //EXECUTA O MIDDLEWARE
        return (new self::$map[$middleware])->handle($request, $next);
    }
}
