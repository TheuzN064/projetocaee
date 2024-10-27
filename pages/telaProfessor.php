<?php
// Conectar ao banco de dados
 include '../config/db.php';

// Inserção de nova solicitação
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome_aluno'])) {
    $nome_aluno = $_POST['nome_aluno'];
    $descricao = $_POST['descricao'];
    $data_solicitacao = $_POST['data_solicitacao'];

    // Preparar e executar a inserção
    $sql = "INSERT INTO solicitacoes (nome_aluno, descricao, data_solicitacao) "
            ."VALUES ('$nome_aluno', '$descricao', '$data_solicitacao')";

    if ($conn->query($sql) === TRUE) {
        echo "Solicitação registrada com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

// Exclusão de solicitação
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    if (!empty($id)) {
        // Preparar a consulta de exclusão
        $sql = "DELETE FROM solicitacoes WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Solicitação excluída com sucesso!";
        } else {
            echo "Erro ao excluir: " . $conn->error;
        }
    } else {
        echo "ID inválido.";
    }
}

// Consulta de todas as solicitações
$sql = "SELECT * FROM solicitacoes";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Solicitações</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .lista {
            max-width: 800px;
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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            text-align: center;
        }
        .btn:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn-alterar {
            background-color: #ffc107;
            color: #fff;
        }
        .btn-excluir {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-alterar:hover {
            background-color: #e0a800;
        }
        .btn-excluir:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h2>Bem-vindo</h2>

<div class="lista">
    <h2>Solicitações</h2>

    <a href="solicitacao.php" class="btn">+ Nova Solicitação</a>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Descrição</th>
                    <th>Data da Solicitação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome_aluno']); ?></td>
                        <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_solicitacao']); ?></td>
                        <td>
                            <!-- Formulário de Alterar -->
                            <form method="POST" action="alterar.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="alterar" class="btn-alterar">Alterar</button>
                            </form>

                            <!-- Formulário de Excluir -->
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn-excluir">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma solicitação registrada.</p>
    <?php endif; ?>
</div>

</body>
</html>

