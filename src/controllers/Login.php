<?php

namespace Controllers;

class Login extends Base{
    
    private $login;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->login = new \Models\Login($this->conexao);
    }
    
    public function login($request, $response) {
        
        $login = $this->getVars();
        
        return $response->withJson($this->login->getLogin($login['loginusuario'], $login['senhausuario']));
    }
    
    public function getVars() {
        $vars = array(
            'loginusuario'  => $this->httpPost('loginusuario'),
            'senhausuario'  => $this->httpPost('senhausuario')
        );
        
        return $vars;
    }
}
