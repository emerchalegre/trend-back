<?php

namespace Models;

class AcompanhaTarefa {
    
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    public function getSprints($id) {

        $stmt = $this->conexao->prepare("
            select 
                s.*,
                p.titulo
            from 
                public.sprint s
            left join public.sprinttarefa t on s.idsprint = t.idsprint    
            left join public.projeto p on s.idprojeto = p.idprojeto
            where 
                t.idtarefa = {$id} and
                p.idsituacao = 1");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getTarefas($id) {

        $stmt = $this->conexao->prepare("
            select 
                sp.*,
                pr.nomeprogramador
            from 
                public.sprinttarefa sp
                left join public.programadores pr on sp.idprogramador = pr.idprogramador
            where 
                sp.idsprint =
                  (
                    select 
                        t.idsprint
                    from public.sprinttarefa t
                    left join public.sprint s on t.idsprint = s.idsprint
                    left join public.projeto p on s.idprojeto = p.idprojeto
                    where 
                        t.idtarefa = {$id} and
                        p.idsituacao = 1
                )
      ");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
}
