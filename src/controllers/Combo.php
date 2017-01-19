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
}
