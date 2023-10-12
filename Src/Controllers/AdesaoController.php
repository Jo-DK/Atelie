<?php

/**
 * Controller para Campanhas
 * 
 * @author Jonathan Nunes
 * @since 2023-11-10
 */

namespace Src\Controllers;

use Src\Models\CampanhaParticipante as Adesao;
use Src\Validation\Validation;

class AdesaoController extends Controller
{
    /**
     * Verifica se o vinculo entre participante e campanha já existe, 
     * depois salva o novo vinculo na tabela Campanha_Participantes
     */
    public static function store()
    {

        $Adesao = new Adesao();
        $Adesao->campanha_id        = Validation::request('campanha_id', ['integer']);
        $Adesao->participante_id    = Validation::request('participante_id', ['integer']);
        $Adesao->dt_adesao          = date('Y-m-d');

        if(Adesao::alreadyExists((int) $Adesao->campanha_id, (int) $Adesao->participante_id))
            self::returnUnprocessable("Participante já esta vinculado!");

        $Adesao->saveDoubleKeys();

        self::returnNoContent(
            'Participante Vinculado à Campanha com sucesso!'
        );
    }

    /**
     * Verifica se o vinculo já existe
     * depois remove do banco
     */
    public static function destroy()
    {
        
        $Adesao = new Adesao();
        $campanha_id        = Validation::request('campanha_id', ['integer']);
        $participante_id    = Validation::request('participante_id', ['integer']);

        $fetch = $Adesao->find(
            "campanha_id = :campanha_id AND participante_id = :participante_id", 
            "campanha_id=$campanha_id&participante_id=$participante_id")->fetch(true);

        if(!$fetch)
            self::returnUnprocessable("Vinculo inexistente, participante não aderiu a esta Campanha");

        $Adesao->destroy();
        self::returnNoContent('Participante desvinculado da Campanha!');
    }
}