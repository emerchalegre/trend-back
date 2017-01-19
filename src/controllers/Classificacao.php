<?php


namespace Controllers;

class Classificacao extends Base{
    
    public function get($request, $response, $args) {
        $combo = new \Models\Combo($this->conexao);
        return $response->withJson($combo->getClassificacao());
    }
}
