<?php

namespace Models\Services;

class GenericDBTable extends DBTable{
    
    public function __construct(\PDO $conexao, $table) {

        $this->_table = $table;
        parent::__construct($conexao);

    }

}
?>
