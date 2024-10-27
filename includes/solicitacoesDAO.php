
<?php
include '../config/db.php';
class Conexao {
    private $conn;
    private $sql;

    public function __construct() {
        $this->conn = new mysqli("sql.freedb.tech", "freedb_lucena", "*J7VuVe&?R&XJTw", "freedb_projetocae");
        if ($this->conn->connect_error) {
            die("Erro de Conexão: " . $this->conn->connect_error);
        }
    }

    public function set($prop, $value) {
        $this->$prop = $value;
    }

    public function query() {
        $resultado = $this->conn->query($this->sql);
        if ($this->conn->error) {
            die("Erro na consulta: " . $this->conn->error);
        }
        return $resultado;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>

<?php 
    class SolicitacoesDAO {

        public $id;
        public $nome_aluno;
        public $descricao;
        public $data_solicitacao;
    
        public function cadastrarSolicitacao() {
            $objeto = new Conexao();
            $SQL = "INSERT INTO solicitacoes (matricula, nome_aluno, descricao, data_solicitacao)
                    VALUES ('$this->matricula', '$this->nome_aluno', '$this->descricao', '$this->data_solicitacao');";
            $objeto->set("sql", $SQL);
            $objeto->query();
            return "Cadastrado com Sucesso";
        }
        
        public function alterarSolicitacao() {
            $objeto = new Conexao();
            $SQL = "UPDATE solicitacoes SET nome_aluno='$this->nome_aluno', descricao='$this->descricao', data_solicitacao='$this->data_solicitacao' WHERE id='$this->id';";
            $objeto->set("sql", $SQL);
            $objeto->query();
            return "Alterado com Sucesso";
        }
        
        public function excluirSolicitacao() {
            $objeto = new Conexao();
            $SQL = "DELETE FROM solicitacoes WHERE matricula = $this->matricula;";
            $objeto->set("sql", $SQL);
            $objeto->query();
            return "Excluido com Sucesso";
        }
    
        public function set($prop, $value) {
            $this->$prop = $value;
        }
        
        public function trazerDadosSolicitacao(){
            $objeto = new Conexao();
            $SQL = "SELECT nome_aluno, descricao, data_solicitacao"
                    . "FROM solicitacoes"
                    . "WHERE matricula LIKE '%$this->matricula%'";
            $objeto->set("sql", $SQL);
            return $objeto->query();
        }
    }
?>