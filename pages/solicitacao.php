<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Advertências</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Formulário de Solicitação de Advertências</h2>
        <form action="telaprofessor.php" method="post">
            <div class="form-group">
                <label for="student_name">Nome do Aluno:</label>
                <input type="text" id="student_name" name="nome_aluno" required>
            </div>

            <div class="form-group">
                <label for="warning_description">Descrição da Advertência:</label>
                <textarea id="warning_description" name="descricao" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="warning_date">Data da Solicitação:</label>
                <input type="date" id="warning_date" name="data_solicitacao" required>
            </div>

            <input type="submit" class="submit-btn" value="Enviar Advertência">
        </form>
    </div>
</body>
</html>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f0f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .form-container {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        padding: 30px;
        animation: fadeIn 0.6s ease-in-out;
    }

    .form-title {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        color: #555;
        margin-bottom: 8px;
    }

    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        outline: none;
    }

    textarea {
        resize: vertical;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #218838;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegar os valores do formulário
    $nome_aluno = $_POST['nome_aluno'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];

    $sql = "INSERT INTO solicitacoes (id, nome_aluno, descricao, data_solicitacao) 
            VALUES ('$id','$nome_aluno', '$descricao', '$data_solicitacao')";
    if ($conn->query($sql) === TRUE) {
        echo"solicitação registrada";
    } else {
        $error = "Erro ao cadastrar: " . $conn->error;
    }
}

?>