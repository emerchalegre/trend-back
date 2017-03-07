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
                *,
                case when idsituacao = 0 then
                    'Finalizado' else  
                    'Em Desenvolvimento' 
                end as situacao 
            from 
                public.sprint 
            where 
                idprojeto = {$id}");
        
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
}
