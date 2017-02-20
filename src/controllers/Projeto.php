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
    
    public function getById($request, $response, $args) {
        return $response->withJson($this->projeto->getProjetoById($args['id']));
    }
    
    public function post($request, $response) {
        
        $projeto     = new \Models\Services\GenericDBTable($this->conexao, 'public.projeto');
        $risco       = new \Models\Services\GenericDBTable($this->conexao, 'public.projetoriscos');
        $solicitante = new \Models\Services\GenericDBTable($this->conexao, 'public.projetosolicitantes');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $vars = $this->getVars();
            
            $idprojeto = $projeto->insert($vars);
            
            foreach ($_POST['gridRiscos'] as $i){
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
            
            foreach ($_POST['gridSolicitante'] as $i){
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
    
    public function delete($request, $response, $args) {
        
        $projeto = new \Models\Services\GenericDBTable($this->conexao, 'public.projeto');
        
        try {
            
            $this->conexao->beginTransaction();
            
            $projeto->delete(array('idprojeto'=>$args['id']));
            
            $this->conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $this->conexao->rollBack();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }
    
    public function getVars() {
        $vars = array(
            'numero'                       => $_POST['formProjeto']['numero'],
            'dataprojeto'                  => $_POST['formProjeto']['dataprojeto'],
            'titulo'                       => $_POST['formProjeto']['titulo'],
            'autordocumento'               => $_POST['formProjeto']['autordocumento'],
            'negocio'                      => $_POST['formProjeto']['negocio'],
            'solicitante'                  => $_POST['formProjeto']['solicitante'],
            'processo'                     => $_POST['formProjeto']['processo'],
            'centrodecusto'                => $_POST['formProjeto']['centrodecusto'],
            'alinhamentoestrategico'       => $_POST['formProjeto']['alinhamentoestrategico'],
            'contratosolicitante'          => $_POST['formProjeto']['contratosolicitante'],
            'objetivo'                     => $_POST['formProjeto']['objetivo'],
            'entendimentodasolicitacao'    => $_POST['formProjeto']['entendimentodasolicitacao'],
            'cenarioatual'                 => $_POST['formProjeto']['cenarioatual'],
            'solucaoproposta'              => $_POST['formProjeto']['solucaoproposta'],
                
            'idclassificacao'              => $_POST['formProjetoDetalhes']['idclassificacao'],
            'demandalegal'                 => $_POST['formProjetoDetalhes']['demandalegal'],
            'datavigor'                    => $_POST['formProjetoDetalhes']['datavigor'],
            'idprevisaoresolucao'          => $_POST['formProjetoDetalhes']['idprevisaoresolucao'],
            'idprevisaofalhas'             => $_POST['formProjetoDetalhes']['idprevisaofalhas'],
            'idquantidadesistemasinternos' => $_POST['formProjetoDetalhes']['idquantidadesistemasinternos'],
            'idsistema'                    => $_POST['formProjetoDetalhes']['idsistema'],
            'idquantidadesistemasexternos' => $_POST['formProjetoDetalhes']['idquantidadesistemasexternos'],
            'sistemasexternos'             => $_POST['formProjetoDetalhes']['sistemasexternos'],
            'idnivelabrangencia'           => $_POST['formProjetoDetalhes']['idnivelabrangencia'],
            'idestabilidade'               => $_POST['formProjetoDetalhes']['idestabilidade'],
            'idconhecimento'               => $_POST['formProjetoDetalhes']['idconhecimento'],
            'custohomemhorades'            => $_POST['formProjetoDetalhes']['custohomemhorades'],
            'custohomemhoraman'            => $_POST['formProjetoDetalhes']['custohomemhoraman'],
            'investimentoprevisto'         => $_POST['formProjetoDetalhes']['investimentoprevisto'],
            'ganhoanual'                   => $_POST['formProjetoDetalhes']['ganhoanual'],
            'roi'                          => $_POST['formProjetoDetalhes']['roi'],
            'premissas'                    => $_POST['formProjetoDetalhes']['premissas'],
            'idsituacao'                   => 1
        );
        
        return $vars;
    }
}
