<?php

namespace Controllers;

class Login extends Base{
    
    private $login;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->login = new \Models\Login($this->conexao);
    }
    
    public function getLogin($request, $response, $args) {
        return $response->withJson($this->login->getLogin($args['id']));
    }
}
