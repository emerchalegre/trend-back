<?php


namespace Controllers;


class Combo extends Base{
    
    private $combo;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->combo = new \Models\Combo($this->conexao);
    }

    public function getClassificacao($request, $response, $args) {
        return $response->withJson($this->combo->getClassificacao());
    }
    
    public function getSistemas($request, $response, $args) {
        return $response->withJson($this->combo->getSistemas());
    }
    
    public function getHoras($request, $response, $args) {
        return $response->withJson($this->combo->getHoras());
    }
    
    public function getSistemasInternos($request, $response, $args) {
        return $response->withJson($this->combo->getSistemasInternos());
    }
    
    public function getSistemasExternos($request, $response, $args) {
        return $response->withJson($this->combo->getSistemasExternos());
    }
    
    public function getAbrangencia($request, $response, $args) {
        return $response->withJson($this->combo->getAbrangencia());
    }
    
    public function getEstabilidade($request, $response, $args) {
        return $response->withJson($this->combo->getEstabilidade());
    }
    
    public function getConhecimento($request, $response, $args) {
        return $response->withJson($this->combo->getConhecimento());
    }
    
    public function getNivelRisco($request, $response, $args) {
        return $response->withJson($this->combo->getNivelRisco());
    }
    
    public function getSituacaoProjeto($request, $response, $args) {
        return $response->withJson($this->combo->getSituacaoProjeto());
    }
    
    public function getProjeto($request, $response, $args) {
        return $response->withJson($this->combo->getProjeto());
    }
    
    public function getProgramadores($request, $response, $args) {
        return $response->withJson($this->combo->getProgramadores());
    }
}
