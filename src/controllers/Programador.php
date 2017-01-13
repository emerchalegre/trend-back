<?php

namespace Controllers;

class Programador extends Base{
    
    public function get($request, $response, $args) {
        $programador = new \Models\Programador($this->conexao);
        return $response->withJson($programador->getProgramador());
    }

    public function getById($request, $response, $args) {
        $id = $args['id'];

        $validations = [
            v::intVal()->validate($id)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $programador = Models\Usuario::with('relationClube', 'relationPlano')
                    ->find($id);

            if ($programador) {
                echo self::encode($programador);
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
            'nomeprogramador'  => $this->httpPost('nomeprogramador'),
            'emailprogramador' => $this->httpPost('emailprogramador'),
            'idsituacao'       => $this->httpPost('idsituacao')
        );
        
        return $vars;
    }

    public function post($request, $response) {

        $programador = new \Models\Services\GenericDBTable($this->conexao, 'public.programadores');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            
            $programador->insert($vars);
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
        
    }

    public function update($request, $response, $args) {

        $programador = new \Models\Services\GenericDBTable($this->conexao, 'public.usuario');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            $vars['idusuario'] = $args['id'];
            
            $programador->update($vars, array('idusuario'));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

    public function delete($request, $response, $args) {
        
        $programador = new \Models\Services\GenericDBTable($this->conexao, 'public.usuario');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $programador->delete(array('idusuario'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

}
