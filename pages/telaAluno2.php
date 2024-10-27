<?php

session_start(); // Inicia a sessão

// Verifica se o aluno está logado
if (!isset($_SESSION['aluno_cpf'])) {
    header("Location: login.php"); // Redireciona para a página de login
    exit();
}


// Conectar ao banco de dados
$servername = "localhost:3308"; // Ou outro servidor se não for local
$username = "root"; // Ou o nome de usuário do seu banco de dados
$password = "1234"; // Ou a senha do seu banco de dados
$dbname = "projetocae"; // Nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);



// Consulta de todas as solicitações aplicadas ao aluno
$sql = "SELECT * FROM solicitacoes";
$result = $conn->query($sql);

$conn->close();


$cpf_aluno = $_SESSION['aluno_cpf'];

// Consulta as advertências aplicadas ao aluno
$sql = "SELECT * FROM solicitacoes WHERE cpf_aluno = ?"; // Supondo que você tenha um campo cpf_aluno na tabela solicitacoes
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf_aluno);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/telaProfessor.css">
    <title>Página de Solicitações</title>
</head>
<body>

<h2>Suas advertências</h2>

<div class="lista">
    <h2>Advertencias aplicadas</h2>

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