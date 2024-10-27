<?php 
    class AlunoDAO {

        /*public $nome;
        public $email;
    */
        public $cpf;
        public $senha;
    
        public function cadastrarAluno() {
            $objeto = new Conexao();
            $SQL = "INSERT INTO aluno (cpf, senha)
                    VALUES ('$this->cpf', '$this->senha');";
            $objeto->set("sql", $SQL);
            $objeto->query();
            return "Cadastrado com Sucesso";
        }
        
        public function alterarAluno() {
            $objeto = new Conexao();
            $SQL = "UPDATE aluno SET /*nome='$this->nome', email='$this->email',*/ senha='$this->senha'"
                    . "WHERE cpf='$this->cpf';";
            $objeto->set("sql", $SQL);
            $objeto->query();
            return "Alterado com Sucesso";
        }
        
        public function excluirAluno() {
            $objeto = new Conexao();
            $SQL = "DELETE FROM aluno WHERE cpf = $this->cpf;";
            $objeto->set("sql", $SQL);
            $objeto->query();
            return "Excluido com Sucesso";
        }
    
        public function set($prop, $value) {
            $this->$prop = $value;
        }
        
        public function trazerDadosAluno(){
            $objeto = new Conexao();
            $SQL = "SELECT /*nome, email, */ cpf, senha"
                    . "FROM aluno"
                    . "WHERE cpf LIKE '%$this->cpf%'";
            $objeto->set("sql", $SQL);
            return $objeto->query();
        }
    }
?>