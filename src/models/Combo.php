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
    
    public function getSistemas() {

        $stmt = $this->conexao->prepare("
            select * from sistemas");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getHoras() {

        $stmt = $this->conexao->prepare("
            select * from quantidadehoras");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getSistemasInternos() {

        $stmt = $this->conexao->prepare("
            select * from quantidadesistemasinternos");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getSistemasExternos() {

        $stmt = $this->conexao->prepare("
            select * from quantidadesistemasexternos");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getAbrangencia() {

        $stmt = $this->conexao->prepare("
            select * from nivelabrangencia");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getEstabilidade() {

        $stmt = $this->conexao->prepare("
            select * from estabilidade");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getConhecimento() {

        $stmt = $this->conexao->prepare("
            select * from conhecimento");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getNivelRisco() {

        $stmt = $this->conexao->prepare("
            select * from nivelderisco");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getSituacaoProjeto() {

        $stmt = $this->conexao->prepare("
            select * from projetosituacao");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getProjeto() {

        $stmt = $this->conexao->prepare("
            select idprojeto, titulo from projeto where idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getProgramadores() {

        $stmt = $this->conexao->prepare("
            select idprogramador, nomeprogramador from programadores order by nomeprogramador");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    

}
