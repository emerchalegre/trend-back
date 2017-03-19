<?php

namespace Models;

class Login {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getLogin($login, $senha) {

        $stmt = $this->conexao->prepare("select * from usuario where loginusuario = '{$login}'");

        $retorno = array();

        if(!$stmt->execute()) {
          $retorno['success'] = false;
          $retorno['message'] = utf8_encode('Erro ao efetuar o login: ' . $stmt->errorInfo()[2]);
          return $retorno;
        }

        $login = $stmt->fetch();
        return $this->validateUser($login, $senha);
    }

    private function validateUser($array, $valor2) {
      if(is_array($array) && count($array) == 0) {
        $retorno['success'] = false;
        $retorno['message'] = utf8_encode('Usuário incorreto');
        $retorno['status'] = array(
          "type" => "failed",
          "message" => utf8_encode('Usuário incorreto'),
          "code" => 412
        );
      } else if (is_array($array) && $array['senhausuario'] !== $valor2) {
        $retorno['status'] = array(
          "type" => "failed",
          "message" => utf8_encode('Senha inválida'),
          "code" => 412
        );
      } else if(is_array($array) && $array['idsituacao'] !== 1 ) {
        $retorno['status'] = array(
          "type" => "failed",
          "message" => utf8_encode('Usuário inativo'),
          "code" => 412
        );
      } else {
        unset($array['senhausuario']);
        $retorno['status'] = array(
          "type" => "success",
          "message" => "Success",
          "code" => 200
        );
        $retorno['data'] = array(
          "usuario" => $array
        );
      }
      return $retorno;
    }
}
