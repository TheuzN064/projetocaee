<?php
class Solicitacoes {
    public $id;
    public $nome_aluno;
    public $descricao;
    public $data_solicitacao;

    public function cadastrarSolicitacao() {
        $objeto = new SolicitacoesDAO();
        $objeto->set("matricula", $this->matricula);
        $objeto->set("nome_aluno", $this->nome_aluno);
        $objeto->set("descricao", $this->descricao);
        $objeto->set("data_solicitacao", $this->data_solicitacao);
        
        return $objeto->cadastrarSolicitacao();
    }
    
    public function alterarSolicitacao() {
        $objeto = new SolicitacoesDAO();
        $objeto->set("id", $this->id);
        $objeto->set("nome_aluno", $this->nome_aluno);
        $objeto->set("descricao", $this->descricao);
        $objeto->set("data_solicitacao", $this->data_solicitacao);
        
        return $objeto->alterarSolicitacao();
    }

    public function excluirSolicitacao() {
        $objeto->set("matricula", $this->matricula);
        $objeto->set("nome_aluno", $this->nome_aluno);
        $objeto->set("descricao", $this->descricao);
        $objeto->set("data_solicitacao", $this->data_solicitacao);
        
        return $objeto->excluirSolicitacao();
    }

    public function trazerDadosSolicitacao() {
        $objeto->set("matricula", $this->matricula);
        $objeto->set("nome_aluno", $this->nome_aluno);
        $objeto->set("descricao", $this->descricao);
        $objeto->set("data_solicitacao", $this->data_solicitacao);
        
        return $objeto->trazerDadosSolicitacao();
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }
}
?>