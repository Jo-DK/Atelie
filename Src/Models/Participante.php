<?php

/**
 * ORM para Participantes
 * 
 * @author Jonathan
 * @since 2023-10-11
 */

namespace Src\Models;

use CoffeeCode\DataLayer\DataLayer;

class Participante extends Datalayer
{
    private $fields = [
        'cpf'
    ];
    
    public function __construct()
    {
        parent::__construct(
            'Participantes', $this->fields, 'id', false);
    }

    /**
     * Pega todas os Participantes cadastrados
     */
    public function getAll(){
        $list = $this->find()->fetch(true);
        $return = [];
        foreach($list as $item)
            $return[] = $item->data();

        return $return;     
    }

    /**
     * Verifica se ja existe o CPF no Banco,
     * Se caso ja exista, e for uma Edição, enviamos o id do participante editado para
     * verificar se não é o mesmo dono.
     * 
     * @param int $cpf
     * @param int|Null $id
     * 
     * @return Bool
     */
    public static function alreadyExists(int $cpf, int $id = null): bool
    {
        $Participante = new self;
        $fetch = $Participante->find("cpf = :cpf", "cpf=$cpf")->fetch(true);
        return  $fetch && $fetch[0]->id !== $id;
    }

}