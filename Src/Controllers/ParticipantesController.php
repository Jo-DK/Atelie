<?php

/**
 * Controller para Participantes
 * 
 * @author Jonathan Nunes
 * @since 2023-11-10
 */

namespace Src\Controllers;

use Src\Models\Participante;
use Src\Validation\Validation;

class ParticipantesController extends Controller
{

    /**
     * Retorna a lista de Participantes cadastrados
     */
    public static function index()
    {
        $Participante = new Participante();

        self::returnOk(
            $Participante->getAll(),
            'Lista de Participantes'
        );
    }

    /**
     * Cria Novo Participante
     * Verifica se o CPF já esta em uso no banco
     */
    public static function store()
    {
        $Participante = new Participante();
        $Participante->cpf      = Validation::request('cpf', ['cpf']);
        $Participante->nome     = Validation::request('nome', ['string']);
        $Participante->email    = Validation::request('email', ['email']);
        
        if(Participante::alreadyExists((int) $Participante->cpf))
            self::returnUnprocessable("Já Existe este cpf cadastrado!");

        $Participante->save();

        if ($Participante->fail())
            self::returnUnprocessable($Participante->fail()->getMessage());

        self::returnCreated(
            ['id' => $Participante->id],
            'Participante adicionada com sucesso'
        );
    }


    /**
     * Exibe os dados de um Participante
     * @param id
     */
    public static function show($data)
    {
        $Participante = (new Participante())->findById($data['id']);

        if ($Participante->fail())
            self::returnUnprocessable($Participante->fail()->getMessage());

        if (empty($Participante->id))
            self::returnNotFound('Não localizada Participante para este ID');
        else
            self::returnOk(
                $Participante->data(),
                'Dados da Participante'
            );
    }

    /**
     * Edita um Participante
     * Caso esteja editando CPF, verifica se o novo CPF não já esta em uso no banco
     * 
     * @param id
     */
    public static function edit($data)
    {
        $Participante = (new Participante())->findById($data['id']);

        if (empty($Participante->id))
            self::returnNotFound('Não localizada Participante para este ID');

        $Participante->cpf      = Validation::request('cpf', ['cpf']);
        $Participante->nome     = Validation::request('nome', ['string']);
        $Participante->email    = Validation::request('email', ['email']);

        if(Participante::alreadyExists((int) $Participante->cpf, $Participante->id))
            self::returnUnprocessable("Já Existe este CPF cadastrado!");

        $Participante->save();
        
        if ($Participante->fail()) {
            echo $Participante->fail()->getMessage();
        }

        self::returnNoContent(
            'Participante alterado com sucesso!'
        );
    }

    /**
     * Remove Participante do banco
     * @param id
     * 
     * PS: Esse aqui poderia ser usado Soft Delete
     */
    public static function destroy($data)
    {
        $Participante = (new Participante())->findById($data['id']);

        if (empty($Participante->id))
            self::returnNotFound('Não localizada Participante para este ID');

        $Participante->destroy();
        self::returnNoContent('Participante removido com sucesso!');
    }
}
