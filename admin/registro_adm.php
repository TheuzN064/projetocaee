<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verification_code = $_POST['verification_code'];

    if ($verification_code == '5542') {
        $sql = "INSERT INTO adm (name, cpf, email, password, type) VALUES ('$name', '$cpf', '$email', '$password', 'admin')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/login.php");
        } else {
            $error = "Erro ao cadastrar: " . $conn->error;
        }
    } else {
        $error = "Código de verificação incorreto";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Administrador</title>
</head>
<body>
<h2>Cadastro de Administrador</h2>
<form method="POST" action="registro_adm.php">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="verification_code">Código de Verificação:</label>
    <input type="text" id="verification_code" name="verification_code" required><br>
    <button type="submit">Cadastrar</button>
    <?php if(isset($error)) echo $error; ?>
</form>
</body>
</html>
