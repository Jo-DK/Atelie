<?php


    use CoffeeCode\Router\Router;

    $router = new Router('http://localhost');
    
    

    $router->namespace('Src\Controllers');

    // Empresas
    
    $router->get('/', 'EmpresasController:home');

    $router->get('/Empresas', 'EmpresasController:index');

    $router->get('/Empresas/{id}', 'EmpresasController:show');

    $router->delete('/Empresas/{id}', 'EmpresasController:destroy');

    $router->put('/Empresas/{id}', 'EmpresasController:edit');

    $router->post('/Empresas', 'EmpresasController:store');



    // Participantes

    $router->get('/', 'ParticipantesController:home');

    $router->get('/Participantes', 'ParticipantesController:index');

    $router->get('/Participantes/{id}', 'ParticipantesController:show');

    $router->delete('/Participantes/{id}', 'ParticipantesController:destroy');

    $router->put('/Participantes/{id}', 'ParticipantesController:edit');

    $router->post('/Participantes', 'ParticipantesController:store');


    // // Campanhas

    // $router->get('/', 'CampanhasController:home');

    // $router->get('/Campanhas', 'CampanhasController:index');

    // $router->get('/Campanhas/{id}', 'CampanhasController:show');

    // $router->delete('/Campanhas/{id}', 'CampanhasController:destroy');

    // $router->put('/Campanhas/{id}', 'CampanhasController:edit');

    // $router->post('/Campanhas', 'CampanhasController:store');
    
    /**
     * Group Error
     * This monitors all Router errors. Are they: 400 Bad Request, 404 Not Found, 405 Method Not Allowed and 501 Not Implemented
     */
    $router->group("error")->namespace("Src/Empresas");
    $router->get("/{errcode}", "Coffee:notFound");

    $router->dispatch();

    
    /*
    * Redirect all errors
    */
    if ($router->error()) {
        dd($router->error());
    }