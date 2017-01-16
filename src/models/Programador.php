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
            idprogramador,
            upper(nomeprogramador) as nomeprogramador,
            emailprogramador,
            case
              when idsituacao = 0 then 'Inativo'
              else 'Ativo'
            end as situacao,
            datacadastro,
            idsituacao
        from
            programadores
        where 
            idsituacao = 1
        order by nomeprogramador");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getProgramadorByName($nome) {

        $stmt = $this->conexao->prepare("
        select 
            idprogramador,
            upper(nomeprogramador) as nomeprogramador,
            emailprogramador,
            case
              when idsituacao = 0 then 'Inativo'
              else 'Ativo'
            end as situacao,
            datacadastro,
            idsituacao
        from
            programadores
        where 
            nomeprogramador ilike '%{$nome}%' and
            idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

}
