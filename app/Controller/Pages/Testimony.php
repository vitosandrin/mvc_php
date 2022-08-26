<?php

namespace App\Controller\Pages;

/* Use View */

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;
use WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Page
{
    /**
     * Método responsável por obter a render dos itens de depoimentos
     * @param Request $request
     * @param Pagination
     * @return string
     */
    private static function getTestimonyItems($request, &$obPagination)
    {
        //DEPOIEMNTOS
        $itens = '';

        //QUANTIDADE TOTAL DE REGISTROS 
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        //PAGINA ATUAL
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //INSTANCIA DE PAGINAÇÃO
        $obPagination = new Pagination ($quantidadeTotal, $paginaAtual, 3);

        //RESULTADOS DA PAGINA 
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        //RENDERIZA O ITEM
        while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
            $itens .= View::render('pages/testimony/item', [
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
            ]);
        };


        //RETORNA OS DEPOIMENTOS
        return $itens;
    }


    /**
     * Controller responsavel por gerenciar req feitas na home
     * @param Request $request
     * @return string 
     */
    public static function getTestimonies($request)
    {
        $content = View::render('pages/testimony', [
            'itens' => self::getTestimonyItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);
        return parent::getPage('Depoimentos - title', $content);
    }

    /**
     * Método responsável por criar um depoimento
     * @param Request $request
     * @return string 
     */
    public static function insertTestimony($request)
    {
        //DADOS DO POST
        $postVars = $request->getPostVars();

        //NOVA INSTANCIA DE DEPOIMENTO
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();
        //RETORNA A PAGINA DE LISTAGEM DE DEPOIMENTOS
        return self::getTestimonies($request);
    }
}
