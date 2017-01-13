<?php

namespace Controllers;

class Usuario extends Base{
    
    public function get($request, $response, $args) {
        $usuario = new \Models\Usuario($this->conexao);
        return $response->withJson($usuario->getUsuario());
    }

    public function getById($request, $response, $args) {
        $id = $args['id'];

        $validations = [
            v::intVal()->validate($id)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $usuario = Models\Usuario::with('relationClube', 'relationPlano')
                    ->find($id);

            if ($usuario) {
                echo self::encode($usuario);
            } else {
                $status = 404;

                echo $this->error(
                        'get#usuarios{id}', $request->getUri()->getPath(), $status
                );

                return $response->withStatus($status);
            }
        }
    }
    
    public function getVars() {
        $vars = array(
            'nomeusuario'  => $this->httpPost('nomeusuario'),
            'loginusuario' => $this->httpPost('loginusuario'),
            'senhausuario' => $this->httpPost('senhausuario'),
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
