<?php


namespace Controllers;

class Combo extends Base{
    
    public function getClassificacao($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getClassificacao());
    }
    
    public function getSistemas($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getSistemas());
    }
    
    public function getHoras($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getHoras());
    }
    
    public function getSistemasInternos($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getSistemasInternos());
    }
    
    public function getSistemasExternos($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getSistemasExternos());
    }
    
    public function getAbrangencia($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getAbrangencia());
    }
    
    public function getEstabilidade($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getEstabilidade());
    }
    
    public function getConhecimento($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getConhecimento());
    }
    
    public function getNivelRisco($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getNivelRisco());
    }
}
