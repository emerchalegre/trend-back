<?php

namespace Controllers;

class Programador extends Base{
    
    public function get($request, $response, $args) {
        $programador = new \Models\Programador($this->conexao);
        return $response->withJson($programador->getProgramador());
    }

    public function getByName($request, $response, $args) {
        $name = $args['id'];
        
        $programador = new \Models\Programador($this->conexao);
        return $response->withJson($programador->getProgramadorByName($name));

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

        $programador = new \Models\Services\GenericDBTable($this->conexao, 'public.programadores');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            $vars['idprogramador'] = $args['id'];
            
            $programador->update($vars, array('idprogramador'));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

    public function delete($request, $response, $args) {
        
        $programador = new \Models\Services\GenericDBTable($this->conexao, 'public.programadores');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $programador->delete(array('idprogramador'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

}
