<?php
// Conectar ao banco de dados
include '../config/db.php';
// Executar a consulta para buscar as solicitações
$sql = "SELECT * FROM solicitacoes";
$result = $conn->query($sql);

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

// Fechar a conexão ao final (opcional, para liberar recursos)
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/telaCae.css">
    <title>Solicitações para cadastro de advertências</title>
</head>
<body>

<h2>Bem-vindo</h2>

<div class="lista" id="solicitacoes-container">
    <h2>Solicitações</h2>
    <span class="arrow" id="arrow">&#x25B2;</span>

    <div class="table-container">
        <?php if ($result && $result->num_rows > 0): ?>
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
                                <form method="POST" action="../pages/ocorrencias.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="alterar" class="btn-alterar">Cadastrar</button>
                                </form>

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
</div>

<script>
    const arrow = document.getElementById('arrow');
    const solicitacoesContainer = document.getElementById('solicitacoes-container');

    arrow.addEventListener('click', function() {
        solicitacoesContainer.classList.toggle('show-table');
        if (solicitacoesContainer.classList.contains('show-table')) {
            arrow.innerHTML = '&#x25BC;';  // Muda para seta para baixo
        } else {
            arrow.innerHTML = '&#x25B2;';  // Muda para seta para cima
        }
    });
</script>

</body>
</html>
