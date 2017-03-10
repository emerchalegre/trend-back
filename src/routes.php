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
$app->get("/situacaoprojeto", "Controllers\Combo:getSituacaoProjeto");
$app->get("/comboprojeto", "Controllers\Combo:getProjeto");
$app->get("/comboprogramadores", "Controllers\Combo:getProgramadores");

//login
$app->any("/login/[{id}]", "Controllers\Login:getLogin");

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
$app->get("/projetos/solicitantes/{id}", "Controllers\Projeto:getSolicitantes");
$app->get("/projetos/riscos/{id}", "Controllers\Projeto:getRiscos");
$app->post("/projetos", "Controllers\Projeto:post");
$app->patch("/projetos/{id}", "Controllers\Projeto:update");
$app->delete("/projetos/{id}", "Controllers\Projeto:delete");
$app->delete("/projetos/solicitantes/{id}", "Controllers\Projeto:removerSolicitante");
$app->delete("/projetos/solicitantes/todos/{id}", "Controllers\Projeto:removerTodosSolicitante");

//sprint
$app->get("/sprint/{id}", "Controllers\Sprint:get");
$app->get("/sprint/tarefas/{id}", "Controllers\Sprint:getTarefas");
$app->post("/sprint", "Controllers\Sprint:post");
$app->patch("/sprint/{id}", "Controllers\Sprint:update");
$app->delete("/sprint/{id}", "Controllers\Sprint:delete");
$app->delete("/sprint/tarefa/{id}", "Controllers\Sprint:deleteTarefa");