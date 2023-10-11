<?php

/**
 * Controller para Empresas
 */

namespace Src\Controllers;

use Src\Models\Empresa;
use Src\Validation\Validation;

class EmpresasController extends Controller
{

    public static function index()
    {
        $Empresa = new Empresa();

        self::returnOk(
            $Empresa->getAll(),
            'Lista de Empresas'
        );
    }

    public static function store()
    {

        $Empresa = new Empresa();
        $Empresa->cnpj          = Validation::request('cnpj', ['cnpj']);
        $Empresa->razao_social  = Validation::request('razao_social', ['string']);
        $Empresa->email         = Validation::request('email', ['email']);
        $Empresa->telefone      = Validation::request('telefone', ['telefone']);
        $Empresa->responsavel   = Validation::request('responsavel', ['string']);
        
        if(Empresa::alreadyExists((int) $Empresa->cnpj))
            self::returnUnprocessable("Já Existe esse CNPJ cadastrado!");

        $Empresa->save();

        if ($Empresa->fail())
            self::returnUnprocessable($Empresa->fail()->getMessage());


        self::returnCreated(
            ['id' => $Empresa->id],
            'Empresa adicionada com sucesso'
        );
    }


    public static function show($data)
    {
        $Empresa = (new Empresa())->findById($data['id']);

        if ($Empresa->fail())
            self::returnUnprocessable($Empresa->fail()->getMessage());

        if (empty($Empresa->id))
            self::returnNotFound('Não localizada Empresa para este ID');
        else
            self::returnOk(
                $Empresa->data(),
                'Dados da Empresa'
            );
    }


    public static function edit($data)
    {

        $_REQUEST = (array) json_decode(file_get_contents("php://input"));

        $Empresa = (new Empresa())->findById($data['id']);

        if (empty($Empresa->id))
            self::returnNotFound('Não localizada Empresa para este ID');

        $Empresa->cnpj          = Validation::request('cnpj', ['cnpj']);
        $Empresa->razao_social  = Validation::request('razao_social', ['string']);
        $Empresa->email         = Validation::request('email', ['email']);
        $Empresa->telefone      = Validation::request('telefone', ['telefone']);
        $Empresa->responsavel   = Validation::request('responsavel', ['string']);

        if(Empresa::alreadyExists((int) $Empresa->cnpj, $Empresa->id))
            self::returnUnprocessable("Já Existe esse CNPJ cadastrado!");

        $Empresa->save();
        
        if ($Empresa->fail()) {
            echo $Empresa->fail()->getMessage();
        }

        self::returnNoContent(
            'Empresa alterado com sucesso!'
        );
    }


    public static function destroy($data)
    {

        $Empresa = (new Empresa())->findById($data['id']);

        if (empty($Empresa->id))
            self::returnNotFound('Não localizada Empresa para este ID');

        $Empresa->destroy();
        self::returnNoContent('Empresa removida com sucesso!');
    }
}
