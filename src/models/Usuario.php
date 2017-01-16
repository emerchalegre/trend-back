<?php

namespace Models;

class Usuario {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getUsuario() {

        $stmt = $this->conexao->prepare("
            select 
            *,
            senhausuario as  confirmarsenhausuario,
           case
             when idsituacao = 0 then 'Inativo'
             else 'Ativo' end as situacao
        from 
            usuario
        where 
            idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getUsuarioByName($nome){
        
        $stmt = $this->conexao->prepare("
            select 
            *,
            senhausuario as  confirmarsenhausuario,
           case
             when idsituacao = 0 then 'Inativo'
             else 'Ativo' end as situacao
        from 
            usuario
        where 
            nomeusuario ilike '%{$nome}%' and
            idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

}
