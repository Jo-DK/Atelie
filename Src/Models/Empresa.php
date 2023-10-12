<?php

/**
 * ORM para Empresas
 * 
 * @author Jonathan
 * @since 2023-10-11
 */

namespace Src\Models;

use CoffeeCode\DataLayer\DataLayer;

class Empresa extends Datalayer
{
    private $fields = [
        'cnpj'
    ];
    
    public function __construct()
    {
        parent::__construct(
            'Empresas', $this->fields, 'id', false);
    }

    /**
     * Pega todas as empresas cadastradas
     */
    public function getAll(){
        $list = $this->find()->fetch(true);
        $return = [];
        foreach($list as $item)
            $return[] = $item->data();

        return $return;     
    }

    /**
     * Verifica se ja existe o CNPJ no Banco,
     * Se caso ja exista, e for uma Edição, enviamos o id da empresa editada para
     * verificar se não é o mesmo dono
     * 
     * @param int $cnpj
     * @param int|Null $id
     * 
     * @return Bool
     */
    public static function alreadyExists(int $cnpj, int $id = null): bool
    {
        $Empresa = new self;
        $fetch = $Empresa->find("cnpj = :cnpj", "cnpj=$cnpj")->fetch(true);
        return  $fetch && $fetch[0]->id !== $id;
    }

    }