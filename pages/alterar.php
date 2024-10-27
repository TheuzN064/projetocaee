<?php
// Conectar ao banco de dados
include '../config/db.php';
include '../includes/solicitacoes.php';
include '../includes/solicitacoesDAO.php';

// Se o ID foi passado via POST, pegamos os dados da solicitação
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM solicitacoes WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $solicitacao = $result->fetch_assoc();
    }
}

// Atualizar os dados da solicitação
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome_aluno = $_POST['nome_aluno'];
    $descricao = $_POST['descricao'];
    $data_solicitacao = $_POST['data_solicitacao'];

    // Criação do objeto SolicitacoesDAO
    $objeto2 = new SolicitacoesDAO();
    $objeto2->set("id", $id);  // Defina o ID corretamente
    $objeto2->set("nome_aluno", $nome_aluno);
    $objeto2->set("descricao", $descricao);
    $objeto2->set("data_solicitacao", $data_solicitacao);

    $retorno = $objeto2->alterarSolicitacao();

    if ($retorno != null) {
        echo "Solicitação atualizada com sucesso!";
        header("Location: telaProfessor.php"); // Redireciona após a alteração
    } else {
        echo "Erro ao atualizar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Solicitação</title>
</head>
<body>

<h2>Alterar Solicitação</h2>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $solicitacao['id']; ?>">
    <label for="nome_aluno">Nome do Aluno:</label><br>
    <input type="text" id="nome_aluno" name="nome_aluno" value="<?php echo $solicitacao['nome_aluno']; ?>"><br><br>

    <label for="descricao">Descrição:</label><br>
    <input type="text" id="descricao" name="descricao" value="<?php echo $solicitacao['descricao']; ?>"><br><br>

    <label for="data_solicitacao">Data da Solicitação:</label><br>
    <input type="date" id="data_solicitacao" name="data_solicitacao" value="<?php echo $solicitacao['data_solicitacao']; ?>"><br><br>

    <button type="submit" name="update">Salvar Alterações</button>
</form>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

</body>
</html>