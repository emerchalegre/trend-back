<?php

namespace Models;

class Login {
    
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    public function getLogin($login, $senha) {
        
        $stmt = $this->conexao->prepare("select * from usuario where loginusuario = '{$login}' and senhausuario = '{$senha}'");
        
        $stmt->execute();
        
        return $stmt->fetch();
    }
}
