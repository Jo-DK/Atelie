<?php


    use CoffeeCode\Router\Router;


    $router = new Router('http://localhost');

    $router->namespace('Src\Controllers');

    $router->group(null);

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


    // Campanhas

    $router->get('/', 'CampanhasController:home');

    $router->get('/Campanhas', 'CampanhasController:index');

    $router->get('/Campanhas/{id}', 'CampanhasController:show');

    $router->delete('/Campanhas/{id}', 'CampanhasController:destroy');

    $router->put('/Campanhas/{id}', 'CampanhasController:edit');

    $router->post('/Campanhas', 'CampanhasController:store');
    

    $router->dispatch();

    
    if($router->error()){
        dd($router->error());
    }