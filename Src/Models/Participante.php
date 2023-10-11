<?php

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

        public function getAll(){
            $list = $this->find()->fetch(true);
            $return = [];
            foreach($list as $item)
                $return[] = $item->data();

            return $return;     
        }

        public static function alreadyExists(int $cpf, int $id = null): bool
        {
            $Participante = new self;
            $fetch = $Participante->find("cpf = :cpf", "cpf=$cpf")->fetch(true);
            return  $fetch && $fetch[0]->id !== $id;
        }

    }