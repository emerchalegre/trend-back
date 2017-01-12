<?php

namespace Models\Services;

class DBTable {

    protected $_table;
    protected $_conexao;
    protected $_colunas = array();
    protected $_bind;
    protected $_bindv;

    public function __construct(\PDO $conexao) {

        $this->_conexao = $conexao;

        $this->_setInfoTable();
    }

    /**
     * Retorna Classe PDO
     * @return PDO
     */
    public function getConnection() {
        return $this->_conexao;
    }

    protected function _setInfoTable() {

        if (count($this->_colunas) == 0) {
            foreach ($this->_getInfoTable() as $coluna) {
                $this->_colunas[$coluna['coluna']] = $coluna;
            }
        }
    }

    protected function _getInfoTable() {

        $sql = "SELECT
                    i.table_name as         tabela,
                    i.table_schema          esquema,
                    i.column_name as        coluna,
                    t.constraint_type as    pk_fk,
                    i.data_type as          tipo,
                    i.column_default as     default_value
                FROM
                    information_schema.columns i
                left join
                    information_schema.key_column_usage c on (i.column_name = c.column_name and i.table_name = c.table_name)
                left join
                    information_schema.table_constraints t on (c.constraint_name = t.constraint_name and c.table_name = t.table_name)
                where
                    i.table_schema||'.'||i.table_name = ?
                order by
                    i.ordinal_position, t.constraint_type";

        $select = $this->_conexao->prepare($sql);

        $select->bindParam(1, $this->_table, \PDO::PARAM_STR);

        if (!$select->execute())
            throw new DBTableException('Erro ao localizar informações da tabela');
        else {
            $array = $select->fetchAll();
            return $array;
        }
    }

    public function getDefaultArray() {

        $array = $this->_getInfoTable();

        foreach ($array as $linha)
            $darray[$linha['coluna']] = '';

        return $darray;
    }

    public function insert(Array $array) {

        $sql = $this->_generateInsertSQL($array);

        $insert = $this->_conexao->prepare($sql);
        
        foreach ($this->_bind as $chave => $bind) {
            $insert->bindValue($chave + 1, $bind['valor'], $bind['tipo']);
        }

        $this->_bind = array();

        if (!$insert->execute()) {
            $this->errorInfo = $insert->errorInfo();
            $erro = $this->_conexao->errorInfo();
            //print_r($erro);
            throw new DBTableException($erro[2] . ' - ' . $this->_table);
        } else {
            $result = $insert->fetch();
            return $result['id'];
        }
    }

    protected function _generateInsertSQL(Array $array) {

        foreach ($this->_colunasExistentes($array) as $nome => $atributos) {

            if ($array[$nome] !== '') {

                $coluna[] = $nome;
                $interrogacao[] = '?';
                $this->_bind[] = array(
                    'tipo' => ($atributos['tipo'] == 'integer') ? \PDO::PARAM_INT : \PDO::PARAM_STR,
                    'valor' => $array[$nome]);
            }
        }

        return 'insert into ' . $this->_table . ' (' . implode(', ', $coluna) . ') values (' . implode(', ', $interrogacao) . ') returning ' . $this->_getPk() . ' as id;';
    }

    protected function _colunasExistentes($array) {
        return array_intersect_key($this->_colunas, $array);
    }

    protected function _getPk() {

        foreach ($this->_colunas as $nome => $atributo) {
            if ($atributo['pk_fk'] == 'PRIMARY KEY')
                $pk = $nome;
        }

        return $pk;
    }

    public function delete(Array $array) {

        $sql = $this->_generateDeleteSQL($array);

        $delete = $this->_conexao->prepare($sql);

        foreach ($this->_bind as $chave => $bind) {
            $delete->bindValue($chave + 1, $bind['valor'], $bind['tipo']);
        }

        $this->_bind = array();

        if (!$delete->execute()) {
            $erro = $this->_conexao->errorInfo();
            throw new DBTableException($erro[2]);
        } else {
            return $delete->rowCount();
        }
    }

    private function _generateDeleteSQL(Array $array) {

        foreach ($this->_colunasExistentes($array) as $nome => $atributos) {
            $clausula[] = $nome . ' = ?';
            $this->_bind[] = array('tipo' => ($atributos['tipo'] == 'integer') ? \PDO::PARAM_INT : \PDO::PARAM_STR,
                'valor' => $array[$nome]);
        }

        return 'delete from ' . $this->_table . ' where ' . implode(' AND ', $clausula) . ';';
    }

    public function update(Array $array, Array $arrayverificador) {

        $sql = $this->_generateUpdateSQL($array, $arrayverificador);

        $update = $this->_conexao->prepare($sql);

        foreach ($this->_bind as $chave => $bind) {

            if (trim($bind['valor']) == '') {
                $bind['tipo'] = \PDO::PARAM_NULL;
                $update->bindValue($chave + 1, null, $bind['tipo']);
            } else {
                $update->bindValue($chave + 1, $bind['valor'], $bind['tipo']);
            }
        }

        foreach ($this->_bindv as $chave => $bind) {
            $update->bindValue($chave + 1 + count($this->_bind), $bind['valor'], $bind['tipo']);
        }

        $this->_bind = array();
        $this->_bindv = array();

        if (!$update->execute()) {
            $erro = $this->_conexao->errorInfo();
            throw new DBTableException($erro[2]);
        } else {
            return $update->rowCount();
        }
    }

    protected function _generateUpdateSQL(Array $array, Array $arrayverificador) {

        foreach ($this->_colunasExistentes($array) as $nome => $atributos) {

            if ($atributos['pk_fk'] != 'PRIMARY KEY') {
                $clausula[] = $nome . ' = ?';
                $this->_bind[] = array('tipo' => ($atributos['tipo'] == 'integer') ? \PDO::PARAM_INT : \PDO::PARAM_STR,
                    'valor' => $array[$nome]);
            }
        }

        foreach ($this->_colunasExistentes($array) as $nome => $atributos) {

            if (in_array($nome, $arrayverificador)) {
                $clausulav[] = $nome . ' = ?';
                $this->_bindv[] = array('tipo' => ($atributos['tipo'] == 'integer') ? \PDO::PARAM_INT : \PDO::PARAM_STR,
                    'valor' => $array[$nome]);
            }
        }

        return 'update ' . $this->_table . ' set ' . implode(' , ', $clausula) . ' where ' . implode(' AND ', $clausulav) . ';';
    }

    public function save(Array $array, $verificador) {

        $update = true;

        if (isset($array[$verificador])) {
            if ($array[$verificador] != '' && $array[$verificador] != null) {
                $retorno = $array[$verificador];
                $arrayverificador[] = $verificador;
            } else {
                $update = false;
            }
        } else {
            $update = false;
        }

        if ($update) {
            $this->update($array, $arrayverificador);
            return $retorno;
        } else {
            return $this->insert($array);
        }
    }

    public function deleteDiffArray(array $arrayMemory, array $array, $verificador) {

        if (count($arrayMemory) > 0)
            foreach ($arrayMemory as $aMemory) {
                $chaveMemoria[] = $aMemory[$verificador];
            } else
            $chaveMemoria = array();

        if (count($array) > 0)
            foreach ($array as $a) {
                $chave[] = $a[$verificador];
            } else
            $chave = array();

        $deletes = array_diff($chaveMemoria, $chave);

        if (count($deletes) > 0)
            foreach ($deletes as $delete)
                $this->delete(array($verificador => $delete));

        return $deletes;
    }

    public function arrayReflection() {

        $reflector = new ReflectionClass($this);

        $array = array();

        foreach ($reflector->getProperties() as $propriedade) {

            if ($propriedade->isPublic())
                $array[$propriedade->name] = $this->{$propriedade->name};
        }

        return $array;
    }

    public function insertWithoutReturning(Array $array) {

        $sql = $this->_generateInsertWithoutReturningSQL($array);

        $insert = $this->_conexao->prepare($sql);

        foreach ($this->_bind as $chave => $bind) {
            $insert->bindValue($chave + 1, $bind['valor'], $bind['tipo']);
        }

        $this->_bind = array();

        if (!$insert->execute()) {
            $this->errorInfo = $insert->errorInfo();
            $erro = $this->_conexao->errorInfo();
            throw new DBTableException($erro[2] . ' - ' . $this->_table);
        } else {
            //$result = $insert->fetch();
            //return $result['id'];
        }
    }

    protected function _generateInsertWithoutReturningSQL(Array $array) {

        foreach ($this->_colunasExistentes($array) as $nome => $atributos) {

            if ($array[$nome] !== '') {

                $coluna[] = $nome;
                $interrogacao[] = '?';
                $this->_bind[] = array(
                    'tipo' => ($atributos['tipo'] == 'integer') ? \PDO::PARAM_INT : \PDO::PARAM_STR,
                    'valor' => $array[$nome]);
            } else {

                if ($atributos['tipo'] == 'integer') {
                    if ($array[$nome] == '') {
                        $coluna[] = $nome;
                        $interrogacao[] = '?';
                        $this->_bind[] = array(
                            'tipo' => \PDO::PARAM_NULL,
                            'valor' => null);
                    }
                }
            }
        }

        return 'insert into ' . $this->_table . ' (' . implode(', ', $coluna) . ') values (' . implode(', ', $interrogacao) . ')';
    }

}

?>
