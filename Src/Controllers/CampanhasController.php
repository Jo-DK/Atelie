<?php

/**
 * Controller para Campanhas
 * 
 * @author Jonathan Nunes
 * @since 2023-11-10
 */

namespace Src\Controllers;

use Src\Models\Campanha;
use Src\Validation\Validation;

class CampanhasController extends Controller
{

    /**
     * Retorna todas as campanhas vinculadas a uma Empresa
     * @param empresa_id
     */
    public static function index($data)
    {
        $Campanha = new Campanha();

        self::returnOk(
            $Campanha->getAll($data['empresa_id']),
            'Lista de Campanhas'
        );
    }

    /**
     * Salva nova Campanha no banco
     */
    public static function store()
    {

        $Campanha = new Campanha();
        $Campanha->empresa_id   = Validation::request('empresa_id', ['integer']);
        $Campanha->titulo       = Validation::request('titulo', ['string']);
        $Campanha->descricao    = Validation::request('descricao', ['string']);
        $Campanha->dt_inicio    = Validation::request('dt_inicio', ['date']);
        $Campanha->dt_fim       = Validation::request('dt_fim', ['date']);

        $Campanha->save();

        if ($Campanha->fail())
            self::returnUnprocessable($Campanha->fail()->getMessage());

        self::returnCreated(
            ['id' => $Campanha->id],
            'Campanha adicionada com sucesso!'
        );
    }


    /**
     * Exibe os dados de uma Campanha
     * @param id
     */
    public static function show($data)
    {
        $Campanha = (new Campanha())->findById($data['id']);

        if ($Campanha->fail())
            self::returnUnprocessable($Campanha->fail()->getMessage());

        if (empty($Campanha->id))
            self::returnNotFound('Não localizada Campanha para este ID');
        else
            self::returnOk(
                $Campanha->data(),
                'Dados da Campanha'
            );
    }


    /**
     * Edita uma campanha
     * @param id
     */
    public static function edit($data)
    {
        $Campanha = (new Campanha())->findById($data['id']);

        if (empty($Campanha->id))
            self::returnNotFound('Não localizada Campanha para este ID');

        $Campanha->empresa_id   = Validation::request('empresa_id', ['integer']);
        $Campanha->titulo       = Validation::request('titulo', ['string']);
        $Campanha->descricao    = Validation::request('descricao', ['string']);
        $Campanha->dt_inicio    = Validation::request('dt_inicio', ['date']);
        $Campanha->dt_fim       = Validation::request('dt_fim', ['date']);

        $Campanha->save();
        
        if ($Campanha->fail()) {
            echo $Campanha->fail()->getMessage();
        }

        self::returnNoContent(
            'Campanha alterado com sucesso!'
        );
    }

    /**
     * Remove uma campanha do banco
     * @param id
     */
    public static function destroy($data)
    {
        $Campanha = (new Campanha())->findById($data['id']);

        if (empty($Campanha->id))
            self::returnNotFound('Não foi localizada Campanha para este ID');

        $Campanha->destroy();
        self::returnNoContent('Campanha removido com sucesso!');
    }
}
