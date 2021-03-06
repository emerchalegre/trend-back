<?php

namespace Models;

class Projeto {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getProjeto() {

        $stmt = $this->conexao->prepare("
            select 
                p.*,
                s.descricao as situacao
            from 
                public.projeto p
            left join 
                public.projetosituacao s on p.idsituacao = s.idsituacao
            where 
                p.idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getProjetoByName($nome){
        
        $stmt = $this->conexao->prepare("
            select 
                p.*,
                s.descricao as situacao
            from 
                public.projeto p
            left join 
                public.projetosituacao s on p.idsituacao = s.idsituacao
            where 
                p.titulo ilike '%{$nome}%' and
                p.idsituacao = 1
           ");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getSolicitantes($id){
        
        $stmt = $this->conexao->prepare("
            select 
                p.*
            from 
                public.projetosolicitantes p
            where 
                p.idprojeto = {$id}");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getRiscos($id){
        
        $stmt = $this->conexao->prepare("
            select 
                p.*
            from 
                public.projetoriscos p
            where 
                p.idprojeto = {$id}");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

}
