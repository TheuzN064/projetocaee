<?php
 class Professor {
    public $nome;
    public $email;
    public $cpf;
    public $senha;

    public function cadastrar() {
        $objeto = new ProfessorDAO();
        $objeto->set("nome", $this->nome);
        $objeto->set("email", $this->email);
        $objeto->set("cpf", $this->cpf);
        $objeto->set("senha", $this->senha);
        
        return $objeto->cadastrar();
    }
    
    public function alterar() {
        $objeto = new ProfessorDAO();
        $objeto->set("nome", $this->nome);
        $objeto->set("email", $this->email);
        $objeto->set("cpf", $this->cpf);
        $objeto->set("senha", $this->senha);
        
        return $objeto->alterar();
    }

    public function excluir() {
        $objeto = new ProfessorDAO();
        $objeto->set("cpf", $this->cpf);
        
        return $objeto->excluir();
    }

    public function trazerDados() {
        $objeto = new ProfessorDAO();
        $objeto->set("cpf", $this->cpf);
        
        return $objeto->trazerDados();
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }
}


class ADM {
    public $cpf;
    public $senha;

    public function cadastrar() {
        $objeto = new ADMDAO();
        $objeto->set("cpf", $this->cpf);
        $objeto->set("senha", $this->senha);
        
        return $objeto->cadastrar();
    }
    
    public function alterar() {
        $objeto = new ADMDAO();
        $objeto->set("cpf", $this->cpf);
        $objeto->set("senha", $this->senha);
        
        return $objeto->alterar();
    }

    public function excluir() {
        $objeto = new ADMDAO();
        $objeto->set("cpf", $this->cpf);
        
        return $objeto->excluir();
    }

    public function trazerDados() {
        $objeto = new ADMDAO();
        $objeto->set("cpf", $this->cpf);
        
        return $objeto->trazerDados();
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }
}

?>