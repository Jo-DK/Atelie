<?php

/**
 * Controller para Campanhas
 */

namespace Src\Controllers;

use Src\Models\Campanha;
use Src\Validation\Validation;

class CampanhasController extends Controller
{

    public static function index($data)
    {
        $Campanha = new Campanha();

        self::returnOk(
            $Campanha->getAll($data['empresa_id']),
            'Lista de Campanhas'
        );
    }

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


    public static function edit($data)
    {

        $_REQUEST = (array) json_decode(file_get_contents("php://input"));

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


    public static function destroy($data)
    {

        $Campanha = (new Campanha())->findById($data['id']);

        if (empty($Campanha->id))
            self::returnNotFound('Não foi localizada Campanha para este ID');

        $Campanha->destroy();
        self::returnNoContent('Campanha removido com sucesso!');
    }
}
