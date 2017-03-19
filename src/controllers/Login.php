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
        $values = $this->login->getLogin($login['loginusuario'], $login['senhausuario']);
        $statusCode = $values['status']['code'];
        $this->setSession($values);
        return $response->withStatus($statusCode)->withJson($values);
    }

    public function getVars() {
        $vars = array(
            'loginusuario'  => $this->httpPost('loginusuario'),
            'senhausuario'  => $this->httpPost('senhausuario')
        );

        return $vars;
    }
}
