<?php

namespace Models;

class Login {
    
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    public function getLogin($id) {
        
        $usuario = explode(',', $id);
        
        $stmt = $this->conexao->prepare("select * from usuario where loginusuario = '{$usuario[0]}' and senhausuario = '{$usuario[1]}'");
        
        $stmt->execute();
        
        return $stmt->fetch();
    }
}
