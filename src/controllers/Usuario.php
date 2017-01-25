<?php

namespace Controllers;

class Usuario extends Base{
    
    private $usuario;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->usuario = new \Models\Usuario($this->conexao);
    }
    
    public function get($request, $response, $args) {
        return $response->withJson($this->usuario->getUsuario());
    }

    public function getByName($request, $response, $args) {
        $nome = $args['id'];
        return $response->withJson($this->usuario->getUsuarioByName($nome));
    }
    
    public function getVars() {
        $vars = array(
            'nomeusuario'  => $this->httpPost('nomeusuario'),
            'loginusuario' => $this->httpPost('loginusuario'),
            'senhausuario' => sha1($this->httpPost('senhausuario')),
            'emailusuario' => $this->httpPost('emailusuario'),
            'idsituacao'   => $this->httpPost('idsituacao')
        );
        
        return $vars;
    }

    public function post($request, $response) {

        $usuario = new \Models\Services\GenericDBTable($this->conexao, 'public.usuario');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            
            $usuario->insert($vars);
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
        
    }

    public function update($request, $response, $args) {

        $usuario = new \Models\Services\GenericDBTable($this->conexao, 'public.usuario');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            $vars['idusuario'] = $args['id'];
            
            $usuario->update($vars, array('idusuario'));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

    public function delete($request, $response, $args) {
        
        $usuario = new \Models\Services\GenericDBTable($this->conexao, 'public.usuario');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $usuario->delete(array('idusuario'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

}
