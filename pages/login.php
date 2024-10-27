<?php
// Conexão ao banco de dados
include '../config/db.php';

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Captura os dados enviados pelo formulário
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

// Função para validar as credenciais em uma tabela específica
function verificarLogin($conn, $cpf, $senha, $tabela) {
    $sql = "SELECT * FROM $tabela WHERE cpf = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $cpf, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Verifica as credenciais em cada tabela
if (verificarLogin($conn, $cpf, $senha, 'professor')) {
    // Redirecionar para a página do professor
    
    header("Location: telaProfessor.php");
    exit(); // Adicione exit após o redirecionamento
} elseif (verificarLogin($conn, $cpf, $senha, 'aluno')) {
    // Redirecionar para a página do aluno

    header("Location: telaAluno.php");
    exit(); // Adicione exit após o redirecionamento
} elseif (verificarLogin($conn, $cpf, $senha, 'adm')) {
    // Redirecionar para a página do administrador

    header("Location: telaCae.php");
    exit(); // Adicione exit após o redirecionamento
} else {
    // Login falhou
    echo "CPF ou senha incorretos!";
}

// Fecha a conexão
$conn->close();
?>
