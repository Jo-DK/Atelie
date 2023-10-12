<?php

/**
 * Controller para Empresas
 *  
 * @author Jonathan Nunes
 * @since 2023-11-10
 */

namespace Src\Controllers;

use Src\Models\Empresa;
use Src\Validation\Validation;

class EmpresasController extends Controller
{

    /**
     * Retorna todas as empresas cadastradas
     */
    public static function index()
    {
        $Empresa = new Empresa();

        self::returnOk(
            $Empresa->getAll(),
            'Lista de Empresas'
        );
    }

    /**
     * Cria nova empresa
     * após verificar se CNPJ já não existe no banco
     */
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

    /**
     * Exibe os dados de uma Empresa
     * @param id
     */
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

    /**
     * Edita uma empresa
     * Verifica se, caso esteja editando CNPJ, se o novo CNPJ não já esta em uso no banco
     * 
     * @param id
     */
    public static function edit($data)
    {
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

    /**
     * Remove empresa do banco
     * @param id
     * 
     * PS: Esse aqui poderia ser usado Soft Delete
     */
    public static function destroy($data)
    {
        $Empresa = (new Empresa())->findById($data['id']);

        if (empty($Empresa->id))
            self::returnNotFound('Não localizada Empresa para este ID');

        $Empresa->destroy();
        self::returnNoContent('Empresa removida com sucesso!');
    }
}
