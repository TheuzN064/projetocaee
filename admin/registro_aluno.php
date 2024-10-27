<?php
include '../config/db.php';
include '../includes/AlunoDAO.php';
include '../includes/Aluno.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletando os dados do formulário
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $guardian = $_POST['guardian'];
    $guardian_phone = $_POST['guardian_phone'];
    $cpf = $_POST['cpf'];
    $password = $_POST['password'];

    // Criando uma instância da classe AlunoDAO (presente em advDAO)
    $alunoDAO = new AlunoDAO();

    // Definindo os valores nas propriedades
    $alunoDAO->set('name', $name);
    $alunoDAO->set('dob', $dob);
    $alunoDAO->set('phone', $phone);
    $alunoDAO->set('email', $email);
    $alunoDAO->set('guardian', $guardian);
    $alunoDAO->set('guardian_phone', $guardian_phone);
    $alunoDAO->set('cpf', $cpf);
    $alunoDAO->set('password', $password);

    // Chamando a função cadastrar() do AlunoDAO
    $resultado = $alunoDAO->cadastrarAluno();

    // Verificando o resultado do cadastro
    if ($resultado === TRUE) {
        // Redireciona para a página de login em caso de sucesso
        header("Location: ../pages/login.php");
    } else {
        // Exibe mensagem de erro em caso de falha
        $error = "Erro ao cadastrar: " . $resultado;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Aluno</title>
</head>
<body>
<h2>Cadastro de Aluno</h2>
<form method="POST" action="registro_aluno.php">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="dob">Data de Nascimento:</label>
    <input type="date" id="dob" name="dob" required><br>
    <label for="phone">Telefone:</label>
    <input type="text" id="phone" name="phone" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="guardian">Responsável:</label>
    <input type="text" id="guardian" name="guardian" required><br>
    <label for="guardian_phone">Telefone do Responsável:</label>
    <input type="text" id="guardian_phone" name="guardian_phone" required><br>
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required><br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required><br>
    <button type="submit">Cadastrar</button>
    <?php if(isset($error)) echo $error; ?>
</form>
</body>
</html>
