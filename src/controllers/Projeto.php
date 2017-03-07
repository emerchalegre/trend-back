<?php

namespace Controllers;

class Projeto extends Base{
    
    private $projeto;
    
    public function __construct(\Slim\Container $container) {
        parent::__construct($container);
        $this->projeto = new \Models\Projeto($this->conexao);
    }
    
    public function get($request, $response, $args) {
        return $response->withJson($this->projeto->getProjeto());
    }
    
    public function getByName($request, $response, $args) {
        $nome = $args['id'];
        return $response->withJson($this->projeto->getProjetoByName($nome));
    }
    
    public function getSolicitantes($request, $response, $args) {
        return $response->withJson($this->projeto->getSolicitantes($args['id']));
    }
    
    public function getRiscos($request, $response, $args) {
        return $response->withJson($this->projeto->getRiscos($args['id']));
    }
    
    public function post($request, $response) {
        
        $projeto     = new \Models\Services\GenericDBTable($this->conexao, 'public.projeto');
        $risco       = new \Models\Services\GenericDBTable($this->conexao, 'public.projetoriscos');
        $solicitante = new \Models\Services\GenericDBTable($this->conexao, 'public.projetosolicitantes');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            
            $idprojeto = $projeto->insert($vars);
            
            foreach ($this->httpPost('gridRiscos') as $i){
                $arrayRisco = array(
                    'idprojeto'            => $idprojeto,
                    'risco'                => $i['risco'],
                    'descricaorisco'       => $i['descricaorisco'],
                    'idnivelprobabilidade' => $i['idnivelprobabilidade'],
                    'idnivelimpacto'       => $i['idnivelimpacto'],
                    'idnivelrisco'         => $i['idnivelrisco'],
                    'contramedida'         => $i['contramedida']
                );
                
                $risco->insert($arrayRisco);
                
            }
            
            foreach ($this->httpPost('gridSolicitante') as $i){
                $arraySolicitantes = array(
                    'idprojeto'        => $idprojeto,
                    'nome'             => $i['nome'],
                    'responsabilidade' => $i['responsabilidade'],
                    'data'             => '',
                    'contato'          => $i['contato']
                );
                
                $solicitante->insert($arraySolicitantes);
            }
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
        
    }
    
    public function update($request, $response, $args){
        
        $projeto     = new \Models\Services\GenericDBTable($this->conexao, 'public.projeto');
        $risco       = new \Models\Services\GenericDBTable($this->conexao, 'public.projetoriscos');
        $solicitante = new \Models\Services\GenericDBTable($this->conexao, 'public.projetosolicitantes');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            $vars['idprojeto'] = $args['id'];
            
            $projeto->update($vars, array('idprojeto'));
            
            foreach ($this->httpPost('gridRiscos') as $i){
                $arrayRisco = array(
                    'idrisco'              => $i['idrisco'],
                    'idprojeto'            => $vars['idprojeto'],
                    'risco'                => $i['risco'],
                    'descricaorisco'       => $i['descricaorisco'],
                    'idnivelprobabilidade' => $i['idnivelprobabilidade'],
                    'idnivelimpacto'       => $i['idnivelimpacto'],
                    'idnivelrisco'         => $i['idnivelrisco'],
                    'contramedida'         => $i['contramedida']
                );
                
                $risco->update($arrayRisco, array('idrisco'));
                
            }
            
            
            foreach ($this->httpPost('gridSolicitante') as $i){
                
                $arraySolicitantes = array(
                    'idsolicitante'    => @$i['idsolicitante'],
                    'idprojeto'        => $vars['idprojeto'],
                    'nome'             => $i['nome'],
                    'responsabilidade' => $i['responsabilidade'],
                    'data'             => $i['data'],
                    'contato'          => $i['contato']
                );
                
                /*
                 * em caso de adicionar mais um solicitante no editar
                 * usar o save para dar insert/update
                 */
                
                if(empty($i['idsolicitante'])){
                    unset($arraySolicitantes['idsolicitante']);
                }
                
                $solicitante->save($arraySolicitantes, 'idsolicitante');
            }
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }


    public function delete($request, $response, $args) {
        
        $projeto = new \Models\Services\GenericDBTable($this->conexao, 'public.projeto');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $projeto->delete(array('idprojeto'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }
    
    public function removerSolicitante($request, $response, $args){
        
        $solicitante = new \Models\Services\GenericDBTable($this->conexao, 'public.projetosolicitantes');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $solicitante->delete(array('idsolicitante'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }
    
    public function removerTodosSolicitante($request, $response, $args){
        
        $solicitante = new \Models\Services\GenericDBTable($this->conexao, 'public.projetosolicitantes');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $solicitante->delete(array('idprojeto'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }


    public function getVars() {
        $vars = array(
            'numero'                       => $this->httpPost('formProjeto')['numero'],
            'dataprojeto'                  => $this->httpPost('formProjeto')['dataprojeto'],
            'titulo'                       => $this->httpPost('formProjeto')['titulo'],
            'autordocumento'               => $this->httpPost('formProjeto')['autordocumento'],
            'negocio'                      => $this->httpPost('formProjeto')['negocio'],
            'solicitante'                  => $this->httpPost('formProjeto')['solicitante'],
            'processo'                     => $this->httpPost('formProjeto')['processo'],
            'centrodecusto'                => $this->httpPost('formProjeto')['centrodecusto'],
            'alinhamentoestrategico'       => $this->httpPost('formProjeto')['alinhamentoestrategico'],
            'contratosolicitante'          => $this->httpPost('formProjeto')['contratosolicitante'],
            'objetivo'                     => $this->httpPost('formProjeto')['objetivo'],
            'entendimentodasolicitacao'    => $this->httpPost('formProjeto')['entendimentodasolicitacao'],
            'cenarioatual'                 => $this->httpPost('formProjeto')['cenarioatual'],
            'solucaoproposta'              => $this->httpPost('formProjeto')['solucaoproposta'],
            'idsituacao'                   => $this->httpPost('formProjeto')['idsituacao'],
                
            'idclassificacao'              => $this->httpPost('formProjetoDetalhes')['idclassificacao'],
            'demandalegal'                 => $this->httpPost('formProjetoDetalhes')['demandalegal'],
            'datavigor'                    => $this->httpPost('formProjetoDetalhes')['datavigor'],
            'idprevisaoresolucao'          => $this->httpPost('formProjetoDetalhes')['idprevisaoresolucao'],
            'idprevisaofalhas'             => $this->httpPost('formProjetoDetalhes')['idprevisaofalhas'],
            'idquantidadesistemasinternos' => $this->httpPost('formProjetoDetalhes')['idquantidadesistemasinternos'],
            'idsistema'                    => $this->httpPost('formProjetoDetalhes')['idsistema'],
            'idquantidadesistemasexternos' => $this->httpPost('formProjetoDetalhes')['idquantidadesistemasexternos'],
            'sistemasexternos'             => $this->httpPost('formProjetoDetalhes')['sistemasexternos'],
            'idnivelabrangencia'           => $this->httpPost('formProjetoDetalhes')['idnivelabrangencia'],
            'idestabilidade'               => $this->httpPost('formProjetoDetalhes')['idestabilidade'],
            'idconhecimento'               => $this->httpPost('formProjetoDetalhes')['idconhecimento'],
            'custohomemhorades'            => $this->httpPost('formProjetoDetalhes')['custohomemhorades'],
            'custohomemhoraman'            => $this->httpPost('formProjetoDetalhes')['custohomemhoraman'],
            'investimentoprevisto'         => $this->httpPost('formProjetoDetalhes')['investimentoprevisto'],
            'ganhoanual'                   => $this->httpPost('formProjetoDetalhes')['ganhoanual'],
            'roi'                          => $this->httpPost('formProjetoDetalhes')['roi'],
            'premissas'                    => $this->httpPost('formProjetoDetalhes')['premissas']
            
        );
        
        return $vars;
    }
}
