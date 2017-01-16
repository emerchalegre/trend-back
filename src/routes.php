<?php
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

// Root
$app->get('/', function (RequestInterface $request, ResponseInterface $response, $args) {
    return $response->withStatus(403)->write('Forbidden.');
});

// Usuários
$app->get("/usuarios", "Controllers\Usuario:get");
$app->get("/usuarios/{id}", "Controllers\Usuario:getByName");
$app->post("/usuarios", "Controllers\Usuario:post");
$app->patch("/usuarios/{id}", "Controllers\Usuario:update");
$app->delete("/usuarios/{id}", "Controllers\Usuario:delete");

// Programadores
$app->get("/programadores", "Controllers\Programador:get");
$app->get("/programadores/{id}", "Controllers\Programador:getByName");
$app->post("/programadores", "Controllers\Programador:post");
$app->patch("/programadores/{id}", "Controllers\Programador:update");
$app->delete("/programadores/{id}", "Controllers\Programador:delete");

//Projeto
$app->get("/projetos", "Controllers\Projeto:get");

