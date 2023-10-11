<?php

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
                'Empresas', $this->fields, 'idEmpresa', false);
        }

        public function getAll(){
            $list = $this->find()->fetch(true);
            $return = [];
            foreach($list as $item)
                $return[] = $item->data();

            return $return;     
        }

    }