<?php

include '../config/db.php';

class ProfessorDAO {

    public $nome;
    public $email;
    public $cpf;
    public $senha;

    public function cadastrar() {
        $objeto = new Conexao();
        $SQL = "INSERT INTO professor (nome, email, cpf, senha)
                VALUES ($this->nome, '$this->email', '$this->cpf', '$this->senha');";
        $objeto->set("sql", $SQL);
        $objeto->query();
        return "Cadastrado com Sucesso";
    }
    
    public function alterar() {
        $objeto = new Conexao();
        $SQL = "UPDATE professor SET nome='$this->nome', email='$this->email', senha='$this->senha'"
                . "WHERE cpf='$this->cpf';";
        $objeto->set("sql", $SQL);
        $objeto->query();
        return "Alterado com Sucesso";
    }
    
    public function excluir() {
        $objeto = new Conexao();
        $SQL = "DELETE FROM professor WHERE cpf = $this->cpf;";
        $objeto->set("sql", $SQL);
        $objeto->query();
        return "Excluido com Sucesso";
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }
    
    public function trazerDados(){
        $objeto = new Conexao();
        $SQL = "SELECT nome, email, cpf, senha"
                . "FROM professor"
                . "WHERE cpf LIKE '%$this->cpf%'";
        $objeto->set("sql", $SQL);
        return $objeto->query();
    }
}

class ADMDAO {

    /*public $nome;
    public $email;
*/
    public $cpf;
    public $senha;

    public function cadastrar() {
        $objeto = new Conexao();
        $SQL = "INSERT INTO adm (/*nome, email, */cpf, senha)
                VALUES (/*$this->nome, '$this->email', */'$this->cpf', '$this->senha');";
        $objeto->set("sql", $SQL);
        $objeto->query();
        return "Cadastrado com Sucesso";
    }
    
    public function alterar() {
        $objeto = new Conexao();
        $SQL = "UPDATE adm SET /*nome='$this->nome', email='$this->email',*/ senha='$this->senha'"
                . "WHERE cpf='$this->cpf';";
        $objeto->set("sql", $SQL);
        $objeto->query();
        return "Alterado com Sucesso";
    }
    
    public function excluir() {
        $objeto = new Conexao();
        $SQL = "DELETE FROM adm WHERE cpf = $this->cpf;";
        $objeto->set("sql", $SQL);
        $objeto->query();
        return "Excluido com Sucesso";
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }
    
    public function trazerDados(){
        $objeto = new Conexao();
        $SQL = "SELECT /*nome, email, */ cpf, senha"
                . "FROM adm"
                . "WHERE cpf LIKE '%$this->cpf%'";
        $objeto->set("sql", $SQL);
        return $objeto->query();
    }
}