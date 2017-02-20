<?php
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

// Root
$app->get('/', function (RequestInterface $request, ResponseInterface $response, $args) {
    return $response->withStatus(403)->write('Forbidden.');
});

//Classe combos
$app->get("/classificacao", "Controllers\Combo:getClassificacao");
$app->get("/sistemas", "Controllers\Combo:getSistemas");
$app->get("/hora", "Controllers\Combo:getHoras");
$app->get("/sistemasinternos", "Controllers\Combo:getSistemasInternos");
$app->get("/sistemasexternos", "Controllers\Combo:getSistemasExternos");
$app->get("/abrangencia", "Controllers\Combo:getAbrangencia");
$app->get("/estabilidade", "Controllers\Combo:getEstabilidade");
$app->get("/conhecimento", "Controllers\Combo:getConhecimento");
$app->get("/nivelrisco", "Controllers\Combo:getNivelRisco");

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
$app->get("/projetos/{id}", "Controllers\Projeto:getByName");
$app->get("/projetos/form/{id}", "Controllers\Projeto:getById");
$app->post("/projetos", "Controllers\Projeto:post");
$app->patch("/projetos/{id}", "Controllers\Projeto:update");
$app->delete("/projetos/{id}", "Controllers\Projeto:delete");
