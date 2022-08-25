<?php

namespace App\Utils;

/* View Class Management */

class View
{
    /**
     * Variáveis padrões da view
     * @var array
     */
    private static $vars = [];

    /**
     * Método responsável por definir os dados iniciais da classe
     * @param array $vars
     */
    public static function init($vars = [])
    {
        self::$vars = $vars;
    }
    /**
     * Método responsavel por buscar o nome da view e retornar o conteudo da view requisitada.
     * @param string $view
     * @return string
     */
    private static function getContentView($view)
    {
        /* Chama a pagina como pages/home - pages/produto - etc */
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método reponsável por retornar o conteudo renderizado da view
     * @param string $view
     * @param array $vars (string/number)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        $contentView = self::getContentView($view);
        //MERGE DE VARIAVEIS DO LAYOUT
        $vars = array_merge(self::$vars,$vars);
        //Chaves de variaveis referenciadas nos resources 
        $keys = array_keys($vars);
        //Map para mapear as chaves que serão referenciadas no resources
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);
        /* Replace substitui o content view passando as chaves
         e os valores das variaveis que foram mapeadas */
        return str_replace($keys, array_values($vars), $contentView);
    }
}
