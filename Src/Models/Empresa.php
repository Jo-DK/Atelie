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

        public static function alreadyExists(int $cnpj): bool
        {
            $Empresa = new self;
            return is_array($Empresa->find("cnpj = :cnpj", "cnpj=$cnpj")->fetch(true));
        }

    }