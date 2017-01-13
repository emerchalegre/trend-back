<?php

namespace Models;

class Programador {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getProgramador() {

        $stmt = $this->conexao->prepare("
            select 
            *,
           case
             when idsituacao = 0 then 'Inativo'
             else 'Ativo' end as situacao
        from 
            programadores
        where 
            idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

}
