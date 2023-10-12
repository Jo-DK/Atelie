<?php

    namespace Src\Models;

    use CoffeeCode\DataLayer\DataLayer;
    use CoffeeCode\DataLayer\Connect;

    class CampanhaParticipante extends Datalayer
    {
        private $entity = 'Campanha_Participantes';

        private $fields = [
            'campanha_id',
            'participante_id'
        ];
        
        public function __construct()
        {
            parent::__construct(
                $this->entity, $this->fields, 'campanha_id', false);
        }

        public static function alreadyExists(int $campanha_id, int $participante_id): bool
        {
            $Adesao = new self;
            $fetch = $Adesao->find(
                "campanha_id = :campanha_id AND participante_id = :participante_id", 
                "campanha_id=$campanha_id&participante_id=$participante_id")->fetch(true);
            
            return is_array($fetch);
        }

        public function saveDoubleKeys(): bool
        {
            $data = (array)$this->data;
            $columns    = implode(", ", array_keys($data));
            
            foreach($data as $c => $k)
                $data[$c] = "'$k'";
            
            $values     = implode(", ", array_values($data));

            $sql = "INSERT INTO {$this->entity} ({$columns}) VALUES ({$values})";

            try{
                $stmt = Connect::getInstance($this->database);
                $prepare = $stmt->prepare($sql);
                return dd($prepare->execute(), $sql);
            } catch (\PDOException $exception) {
                $this->fail = $exception;
                return false;
            }

        }
    }