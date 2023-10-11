<?php


    /**
     * Classe para as regras de Validação
     * 
     * a cada nova regra de validação 'CPF, Email, Telefone...', 
     * adicionamos como um método dessa classe 
     */

    namespace Src\Validation;

    use Src\Controllers\Controller;

    class Rules
    {

        static function integer($nome){
            if ( !ctype_digit( strval($_REQUEST[$nome]) ) )
                Controller::returnUnprocessable("Campo $nome precisa representar um número natural!");
            
        }

        static function string($nome){
            if(!is_string($_REQUEST[$nome]) )
                Controller::returnUnprocessable("Campo $nome precisa ser uma String!");
        }

        static function date($nome){
            $array = explode('-', $_REQUEST[$nome]);
            if(!isset($array[2]))
                $array = explode('/', $_REQUEST[$nome]);

            if(!isset($array[2]) || !@checkdate($array[1], $array[2], $array[0]))
                Controller::returnUnprocessable("Campo '$nome' precisa representar uma data válida");
        }

        static function email($nome){
            if(filter_var($_REQUEST[$nome], FILTER_VALIDATE_EMAIL) === false)
                Controller::returnUnprocessable("Campo $nome não é um email Valido!");
        }

        static function cpf($nome){
            // Extrai somente os números
            $cpf = preg_replace( '/[^0-9]/is', '', $_REQUEST[$nome] );
            
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11) {
                Controller::returnUnprocessable("Campo $nome precisa ser um CPF!");
            }

            // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                Controller::returnUnprocessable("Campo $nome Com numeros repetidos!");
            }

            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    Controller::returnUnprocessable("Campo $nome precisa ser um CPF válido!");
                }
            }

            $_REQUEST[$nome] = $cpf;
        }

        static function cnpj($nome){
            $cnpj = $_REQUEST[$nome];
            $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	
            // Valida tamanho
            if (strlen($cnpj) != 14)
                Controller::returnUnprocessable("Campo $nome precisa ser um CNPJ!");
        
            // Verifica se todos os digitos são iguais
            if (preg_match('/(\d)\1{13}/', $cnpj))
                Controller::returnUnprocessable('Todos os numeros do seu CNPJ são iguais!');

            // Valida primeiro dígito verificador
            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
            {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
        
            $resto = $soma % 11;
        
            if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
                return false;
        
            // Valida segundo dígito verificador
            for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
            {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
        
            $resto = $soma % 11;
        
            if($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto) )
                Controller::returnUnprocessable("Campo $nome Não é um CNPJ válido!");

            $_REQUEST[$nome] = $cnpj;
        }

        static function telefone(string $nome){

            $telefone = $_REQUEST[$nome];
            $telefone = preg_replace('/[^0-9]/', '', (string) $telefone);
            $chars = strlen($telefone);
            if($chars != 8 && $chars != 9 && $chars != 11 && $chars != 13 ){
                Controller::returnUnprocessable("Campo $nome deve ser um Telefone válido");
            }

            $_REQUEST[$nome] = $telefone;
        }
    }