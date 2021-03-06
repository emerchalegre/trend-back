<?php

namespace Controllers;

class Sprint extends Base{
    
    private $sprint;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->sprint = new \Models\Sprint($this->conexao);
    }
    
    public function get($request, $response, $args) {
        return $response->withJson($this->sprint->getSprint($args['id']));
    }
    
    public function getTarefas($request, $response, $args) {
        return $response->withJson($this->sprint->getTarefas($args['id']));
    }
    
    public function getTarefasPlayStop($request, $response){
        return $response->withJson($this->sprint->getTarefasPlayStop());
    }


    public function post($request, $response){

        $sprint       = new \Models\Services\GenericDBTable($this->conexao, 'public.sprint');
        $sprintTarefa = new \Models\Services\GenericDBTable($this->conexao, 'public.sprinttarefa');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            
            $idsprint = $sprint->insert($vars);
            
            foreach ($this->httpPost('grid') as $i){
                $arrayTarefa = array(
                    'idsprint'             => $idsprint,
                    'idprogramador'        => $i['idprogramador'],
                    'detalhe'              => $i['detalhe'],
                    'datainicio'           => $i['datainicio'],
                    'horasalmoco'          => $i['horasalmoco'],
                    'horas'                => $i['horas'],
                    'datainiciocalculada'  => $i['datainiciocalculada'],
                    'datafinalcalculada'   => $i['datafinalcalculada']
                );
                
                $sprintTarefa->insert($arrayTarefa);
                
            }
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
        
    }
    
    public function update($request, $response, $args){
        
        $sprint       = new \Models\Services\GenericDBTable($this->conexao, 'public.sprint');
        $sprintTarefa = new \Models\Services\GenericDBTable($this->conexao, 'public.sprinttarefa');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            $vars['idsprint'] = $args['id'];
            
            $sprint->update($vars, array('idsprint'));
            
            foreach ($this->httpPost('grid') as $i){
                
                $arrayTarefa = array(
                    'idtarefa'             => @$i['idtarefa'],
                    'idsprint'             => $vars['idsprint'],
                    'idprogramador'        => $i['idprogramador'],
                    'detalhe'              => $i['detalhe'],
                    'datainicio'           => $i['datainicio'],
                    'horasalmoco'          => $i['horasalmoco'],
                    'horas'                => $i['horas'],
                    'datainiciocalculada'  => $i['datainiciocalculada'],
                    'datafinalcalculada'   => $i['datafinalcalculada']
                );
                
                /*
                 * em caso de adicionar mais uma tarefa no editar
                 * usar o save para dar insert/update
                 */
                
                if(empty($i['idtarefa'])){
                    unset($arrayTarefa['idtarefa']);
                }
                
                $sprintTarefa->save($arrayTarefa, 'idtarefa');
            }
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }
    
    public function delete($request, $response, $args) {
        
        $sprint = new \Models\Services\GenericDBTable($this->conexao, 'public.sprint');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $sprint->delete(array('idsprint'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }
    
    public function deleteTarefa($request, $response, $args) {
        
        $sprintTarefa = new \Models\Services\GenericDBTable($this->conexao, 'public.sprinttarefa');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $sprintTarefa->delete(array('idtarefa'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }


    public function getVars(){
        
        $vars = array(
            'idprojeto'     => $this->httpPost('idprojeto'),
            'titulosprint'  => $this->httpPost('form')['titulosprint'],
            'datasprint'    => $this->httpPost('form')['datasprint']
        );
        
        return $vars;
    }
    
}
