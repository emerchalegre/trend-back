<?php

namespace Controllers;

use Models;
use Respect\Validation\Validator as v;

class Clube extends Base {

    /**
     * Pega todos clubes
     *
     * @return void
     */
    public function get($request, $response, $args) {

        $stmt = $this->container['db']->prepare("select 
                                                        *,
                                                        senhausuario as  confirmarsenhausuario,
                                                   case
                                                     when idsituacao = 0 then 'Inativo'
                                                     else 'Ativo' end as situacao
                                                from usuario");
        $stmt->execute();
        return $response->withJson($stmt->fetchAll());
        //$response->getBody()->write(json_encode($stmt->fetchAll()));
    }

    /**
     * Pega clube pelo id
     * $request e $response usam interface psr7
     * $args contém os argumentos informados na rota
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @param array $args
     * @return void|Slim\Http\Response
     */
    public function getById($request, $response, $args) {
        $id = $args['id'];

        $validations = [
            v::intVal()->validate($id)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $clube = Models\Clube::find($id);

            if ($clube) {
                echo self::encode($clube);
            } else {
                $status = 404;

                echo $this->error(
                        'get#clubes{id}', $request->getUri()->getPath(), $status
                );

                return $response->withStatus($status);
            }
        }
    }

    /**
     * Pega todos usuários de um clube pelo id
     * $request e $response usam interface psr7
     * $args contém os argumentos informados na rota
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @param array $args
     * @return void|Slim\Http\Response
     */
    public function getUsuariosById($request, $response, $args) {
        $id = $args['id'];

        $validations = [
            v::intVal()->validate($id)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $clube = Models\Clube::with('relationUsuarios.relationPlano')->find($id);

            if ($clube) {
                echo self::encode($clube);
            } else {
                $status = 404;

                echo $this->error(
                        'get#clubes{id}usuarios', $request->getUri()->getPath(), $status
                );

                return $response->withStatus($status);
            }
        }
    }

    /**
     * Inclui clube
     * $request e $response usam interface psr7
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return Slim\Http\Response
     */
    public function set($request, $response) {
        $nome = $this->httpPost('nomeusuario');
        print_r($nome);exit;
        $validations = [
            v::stringType()->length(2)->validate($nome)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $clube = new Models\Clube;

            $clube->clb_nome = $nome;

            $clube->save();

            $path = $request->getUri()->getPath() . '/' . $clube->clb_id;

            echo $this->resource($path); // retorna a localização do resource conforme spec para REST

            return $response->withStatus(201); // retorna status 201 quando resource é criado conforme spec para REST
            //echo json_encode(array('success' => true));
        }
        
    }

    /**
     * Atualiza o clube
     * $request e $response usam interface psr7
     * $args contém os argumentos informados na rota
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @param array $args
     * @return void|Slim\Http\Response
     */
    public function update($request, $response, $args) {
        $id = $args['id'];
        $nome = $this->httpPost('nome');

        $validations = [
            v::intVal()->validate($id),
            v::stringType()->length(2)->validate($nome)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $clube = Models\Clube::find($id);

            if ($clube) {
                $clube->clb_nome = $nome;

                $clube->save();
            } else {
                $status = 404;

                echo $this->error(
                        'patch#clubes{id}', $request->getUri()->getPath(), $status
                );

                return $response->withStatus($status);
            }
        }
    }

    /**
     * Deleta o clube
     * $request e $response usam interface psr7
     * $args contém os argumentos informados na rota
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @param array $args
     * @return void|Slim\Http\Response
     */
    public function delete($request, $response, $args) {
        $id = $args['id'];

        $validations = [
            v::intVal()->validate($id)
        ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        } else {
            $clube = Models\Clube::with('relationUsuarios')->find($id);

            if ($clube) {
                $usuarios = $clube->relationUsuarios->all();

                if ($usuarios) {
                    $status = 403;

                    echo $this->error(
                            'delete#clubes{id}', $request->getUri()->getPath(), $status, 'FK_CONSTRAINT_ABORT'
                    );

                    return $response->withStatus($status);
                } else {
                    $clube->delete();
                }
            } else {
                $status = 404;

                echo $this->error(
                        'delete#clubes{id}', $request->getUri()->getPath(), $status
                );

                return $response->withStatus($status);
            }
        }
    }

}
