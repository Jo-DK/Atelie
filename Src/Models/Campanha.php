<?php

/**
 * ORM para Campanhas
 * 
 * @author Jonathan
 * @since 2023-10-11
 */

namespace Src\Models;

use CoffeeCode\DataLayer\DataLayer;

class Campanha extends Datalayer
{
    /** Campos obrigatórios */
    private $fields = [
        'empresa_id',
        'titulo'
    ];
    
    public function __construct()
    {
        parent::__construct(
            'Campanhas', $this->fields, 'id', false);
    }

    /** 
     * Faz uma query para pegar todos as empresas,
     * Como o Datalayer retorna uma array de Objetos Datalayer, eu também faço um foreach
     * para pegar somente os dados de cada objeto 
     * 
     * @param $empresa_id
     * */
    public function getAll(int $empresa_id){
        $list = $this->find("empresa_id = :empresa_id", "empresa_id=$empresa_id")->fetch(true);
        $return = [];
        foreach($list as $item)
            $return[] = $item->data();

        return $return;
    }

}