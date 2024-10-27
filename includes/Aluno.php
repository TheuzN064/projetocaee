<?php
class Aluno {
    public $cpf;
    public $senha;

    public function cadastrarAluno() {
        $objeto = new AlunoDAO();
        $objeto->set("cpf", $this->cpf);
        $objeto->set("senha", $this->senha);
        
        return $objeto->cadastrarAluno();
    }
    
    public function alterarAluno() {
        $objeto = new AlunoDAO();
        $objeto->set("cpf", $this->cpf);
        $objeto->set("senha", $this->senha);
        
        return $objeto->alterarAluno();
    }

    public function excluirAluno() {
        $objeto = new AlunoDAO();
        $objeto->set("cpf", $this->cpf);
        
        return $objeto->excluirAluno();
    }

    public function trazerDadosAluno() {
        $objeto = new AlunoDAO();
        $objeto->set("cpf", $this->cpf);
        
        return $objeto->trazerDadosaluno();
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }
}
?>