<?php

namespace Models;

class Combo {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getClassificacao() {

        $stmt = $this->conexao->prepare("
            select * from classificacao");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    

}
