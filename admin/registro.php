<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>

<h2>Cadastro</h2>
<form method="POST" action="registro.php">
    <label for="type">Quer cadastrar quem ?</label>
    <select id="type" name="type">
        <option value="admin">Administrador</option>
        <option value="prafessor">Professor</option>
        <option value="estudante">Aluno</option>
    </select><br>
    <button type="submit">Próximo</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    if ($type == "admin") {
        header("Location: registro_adm.php");
    }else if ($type == "professor") {
        header("Location: register_student.php");
    }else if ($type == "estudante"){
        header("Location:  registro_aluno.php");
    }
}
?>
</body>
</html>
