<?php

    namespace Src\Models;

    use CoffeeCode\DataLayer\DataLayer;

    class Campanha extends Datalayer
    {
        private $fields = [
            'empresa_id',
            'titulo'
        ];
        
        public function __construct()
        {
            parent::__construct(
                'Campanhas', $this->fields, 'id', false);
        }

        public function getAll(int $empresa_id){
            $list = $this->find("empresa_id = :empresa_id", "empresa_id=$empresa_id")->fetch(true);
            $return = [];
            foreach($list as $item)
                $return[] = $item->data();

            return $return;
        }

    }