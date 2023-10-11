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
                'Empresas', $this->fields, 'id', false);
        }

        public function getAll(){
            $list = $this->find()->fetch(true);
            $return = [];
            foreach($list as $item)
                $return[] = $item->data();

            return $return;     
        }

        public static function alreadyExists(int $cnpj, int $id = null): bool
        {
            $Empresa = new self;
            $fetch = $Empresa->find("cnpj = :cnpj", "cnpj=$cnpj")->fetch(true);
            return  $fetch && $fetch[0]->id !== $id;
        }

    }