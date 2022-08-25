<?php

namespace App\Utils;

/* View Class Management */
class View
{
    /**
     * Método responsavel por retornar o conteudo da view requisitada.
     * @param string $view
     * @return string
     */
    private static function getContentView($view)
    {
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

        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        },$keys);
        
        echo "<pre>";
        print_r($keys);
        echo "</pre>";

        return str_replace($keys, array_values($vars), $contentView);
    }
}
