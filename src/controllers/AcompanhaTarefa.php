<?php


namespace Controllers;


class AcompanhaTarefa extends Base{
    
    private $acompanha;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->acompanha = new \Models\AcompanhaTarefa($this->conexao);
    }
    
    public function getSprints($request, $response, $args) {
        return $response->withJson($this->acompanha->getSprints($args['id']));
    }
    
    public function getTarefas($request, $response, $args) {
        return $response->withJson($this->acompanha->getTarefas($args['id']));
    }
}
