<?php

/**
 * Controller para Campanhas
 */

namespace Src\Controllers;

use Src\Models\CampanhaParticipante as Adesao;
use Src\Validation\Validation;

class AdesaoController extends Controller
{
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

    public static function destroy()
    {
        $_REQUEST = (array) json_decode(file_get_contents("php://input"));
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