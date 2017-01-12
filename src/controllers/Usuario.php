<?php

namespace Controllers;

class Usuario extends Base{
    
    public function get($request, $response, $args) {
        $usuario = new \Models\Usuario($this->container['db']);
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

    public function set($request, $response) {

        $conexao = $this->container['db'];
        //$conexao = new \PDO('pgsql:host=localhost;port=5432;dbname=trend_project', 'postgres', 'root');
        //print_r($conexao);exit;
        $usuario = new \Models\Services\GenericDBTable($conexao, 'public.usuario');
        
        try {
            
            $conexao->beginTransaction();
            
            $vars = $this->getVars();
            
            $usuario->insert($vars);
            
            $conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $conexao->rollBack();

            $error = $conexao->errorInfo();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
        
    }

    public function update($request, $response, $args) {
        print_r($args);exit;
        $conexao = $this->container['db'];
        $usuario = new \Models\Services\GenericDBTable($conexao, 'public.usuario');
        
        try {
            
            $conexao->beginTransaction();
            
            $vars = $this->getVars();
            $vars['idusuario'] = $args['id'];
            
            $usuario->update($vars, array('idusuario'));
            
            $conexao->commit();
            
            return $response->withJson(array('success' => 1));
            //return $response->withStatus(200);
            
        } catch (\Exception $e) {
            
            $conexao->rollBack();

            $error = $conexao->errorInfo();

            return $response->withJson(array('success' => 0, 'error' => $e->getMessage()));
            
        }
    }

    public function delete($request, $response, $args) {
        $id = $args['id'];

        $validations = [
            v::intVal()->validate($id)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $usuario = Models\Usuario::with('relationDependentes')->find($id);

            if ($usuario) {
                $dependentes = $usuario->relationDependentes->all();

                if ($dependentes) {
                    $status = 403;

                    echo $this->error(
                            'delete#usuarios{id}', $request->getUri()->getPath(), $status, 'FK_CONSTRAINT_ABORT'
                    );

                    return $response->withStatus($status);
                } else {
                    $usuario->delete();
                }
            } else {
                $status = 404;

                echo $this->error(
                        'delete#usuarios{id}', $request->getUri()->getPath(), $status
                );

                return $response->withStatus($status);
            }
        }
    }

}
