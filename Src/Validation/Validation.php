<?php


    /**
     * Classe para validação de dados enviados nas requisições
     * Ele pega a variavel de dentro da array $_REQUEST e verifica as regras 
     * passadas 
     * caso não atenda, um erro sera retornado 
     * 
     * Ela também pode limpar mascaras em alguns casos como CPF e Telefone
     * 
     * @author Jonathan Nunes
     */


    namespace Src\Validation;


    class Validation extends Rules
    {
        /**
         * Pega o parametro em $_REQUEST e faz todas as validações nele
         * 
         * @param nome, nome do campo, chave no $_REQUEST
         * @param rules, array com todas as regras que deverão ser aplicadas
         * @param default, caso não existe, retornar esse valor, $default não pode ser Null
         * 
         * @return value caso este seja aprovado pelas validações
         */
        static function request(string $nome, array $rules = [])
        {
            self::checkIfPut();

            foreach( $rules as $rule)
                static::$rule($nome);

            return $_REQUEST[$nome];

        }

        /**
         * Caso o método seja PUT
         * Então precisamos setar a variavel global $_REQUEST com os dados enviados
         */
        static private function checkIfPut()
        {
            if( $_SERVER['REQUEST_METHOD'] == 'PUT')
                $_REQUEST = (array) json_decode(file_get_contents("php://input"));
        }
    }