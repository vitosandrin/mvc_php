<?php

namespace App\Model\Entity;
use \WilliamCosta\DatabaseManager\Database;

class Testimony
{
    /**
     * ID do depoimento
     * @var integer 
     */
    public $id;

    /**
     * Nome do usuario owner do dep
     * @var string
     */
    public $nome;

    /**
     * Mensagem do user
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicação do depoimento
     * @var string
     */
    public $data;

    /**
     * Método responsavel por cadastrar a instancia atual no BD 
     * @return boolean
     */
    public function cadastrar(){
        //DEFINE A DATA
        $this->data = date('Y-m-d H:i:s');
        //INSERE O DEPOIMENTO NO BANCO DE DADOS 
        $this->id = (new Database('depoimentos'))->insert([
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
            'data' => $this->data
        ]);
        return true;
    }

    /**
     * Método responsável por retornar Depoimnetos 
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return PDOStatement
     */
    public static function getTestimonies($where = null, $order = null, $limit = null, $fields = '*'){
        return(new Database('depoimentos'))->select($where,$order,$limit,$fields);
    }
}
