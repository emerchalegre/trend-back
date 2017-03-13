<?php

namespace Models;

class Sprint {
    
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    public function getSprint($id) {

        $stmt = $this->conexao->prepare("
            select 
                *
            from 
                public.sprint 
            where 
                idprojeto = {$id}
            order by datasprint");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getTarefas($id) {

        $stmt = $this->conexao->prepare("
            select 
                *
            from 
                public.sprinttarefa st
            where 
                st.idsprint = {$id}");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getTarefasPlayStop() {

        $stmt = $this->conexao->prepare("
            select 
                t.idtarefa,
                t.detalhe as descricaotarefa
            from 
                public.sprinttarefa t
                left join public.sprint s on t.idsprint = s.idsprint    
                left join public.projeto p on s.idprojeto = p.idprojeto
            where 
                p.idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
