<?php


include '../config/db.php';

// Função para validar CPF (simples)
function validar_cpf($cpf) {
    return preg_match('/^[0-9]{11}$/', $cpf);
}

// Função para validar matrícula (16 dígitos numéricos)
function validar_matricula($matricula) {
    return preg_match('/^[0-9]{16}$/', $matricula);
}

// Função para validar que um campo contém apenas letras
function validar_somente_letras($valor) {
    return preg_match('/^[A-Za-zÀ-ÿ\s]+$/', $valor); // Aceita letras, espaços e caracteres acentuados
}

$erros = [];

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validações do lado do servidor
    if (empty($_POST['tipo']) || !validar_somente_letras($_POST['tipo'])) {
        $erros[] = "O campo 'Tipo de Advertência' é obrigatório e deve conter apenas letras.";
    }
    if (empty($_POST['etapa_processo'])) {
        $erros[] = "O campo 'Etapa do Processo' é obrigatório.";
    }
    if (empty($_POST['estudante_mat']) || !validar_matricula($_POST['estudante_mat'])) {
        $erros[] = "O campo 'Matrícula do Estudante' é obrigatório e deve conter exatamente 16 dígitos numéricos.";
    }
    if (empty($_POST['responsavel_ocor_cpf']) || !validar_cpf($_POST['responsavel_ocor_cpf'])) {
        $erros[] = "O campo 'CPF do Responsável' é obrigatório e deve conter 11 dígitos numéricos.";
    }
    if (empty($_POST['descricao'])) {
        $erros[] = "O campo 'Descrição da Ocorrência' é obrigatório.";
    }
    if (empty($_POST['status_de_conclusao']) || !validar_somente_letras($_POST['status_de_conclusao'])) {
        $erros[] = "O campo 'Status de Conclusão' é obrigatório e deve conter apenas letras.";
    }
    if (empty($_POST['servidor_responsavel']) || !validar_somente_letras($_POST['servidor_responsavel'])) {
        $erros[] = "O campo 'Servidor Responsável' é obrigatório e deve conter apenas letras.";
    }
    if (empty($_POST['infracao_artigo'])) {
        $erros[] = "O campo 'Infração (Artigo)' é obrigatório.";
    }

    // Se não houver erros, inserir no banco de dados
    if (empty($erros)) {
        $tipo = $_POST['tipo'];
        $etapa_processo = $_POST['etapa_processo'];
        // $estudante_mat = $_POST['estudante_mat'];
        $responsavel_ocor_cpf = $_POST['responsavel_ocor_cpf'];
        $descricao = $_POST['descricao'];
        $status_de_conclusao = $_POST['status_de_conclusao'];
        $servidor_responsavel = $_POST['servidor_responsavel'];
        $infracao_artigo = $_POST['infracao_artigo'];

        // Montar a query de inserção no banco de dados
        $sql = "INSERT INTO ocorrencias (tipo, etapa_processo, status_de_conclusao, responsavel_ocor_cpf, servidor_responsavel, descricao, infracao_artigo)
                VALUES ('$tipo', '$etapa_processo', '$status_de_conclusao', '$responsavel_ocor_cpf', '$servidor_responsavel', '$descricao', '$infracao_artigo')";

        // Executar a query
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Advertência cadastrada com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar a advertência: " . $conn->error . "');</script>";
        }

        // Fechar a conexão
        $conn->close();
    } else {
        // Exibir erros em alertas de JavaScript
        echo "<script>alert('" . implode("\\n", $erros) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/ocorrencias.css">
    <title>Cadastro de Advertência</title>
</head>

<body>

    <div class="container">
        <div class="tabs">
            <button class="active" onclick="openTab(event, 'dados')">Dados Pessoais</button>
            <button onclick="openTab(event, 'ocorrencia')">Ocorrência</button>
            <button onclick="openTab(event, 'conclusao')">Conclusão</button>
        </div>

        <!-- Formulário principal -->
        <form method="POST" onsubmit="return validarFormulario();">
            <!-- Aba 1: Dados Pessoais -->
            <div id="dados" class="tab-content active">
                <label for="tipo">Tipo de Advertência:</label>
                <input type="text" id="tipo" name="tipo" required>

                <label for="etapa_processo">Etapa do Processo:</label>
                <input type="text" id="etapa_processo" name="etapa_processo" required>
            </div>

            <!-- Aba 2: Ocorrência -->
            <div id="ocorrencia" class="tab-content">
                <label for="estudante_mat">Matrícula do Estudante:</label>
                <input type="text" id="estudante_mat" name="estudante_mat" required>

                <label for="responsavel_ocor_cpf">CPF do Responsável pela Ocorrência:</label>
                <input type="text" id="responsavel_ocor_cpf" name="responsavel_ocor_cpf" required>

                <label for="descricao">Descrição da Ocorrência:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
            </div>

            <!-- Aba 3: Conclusão -->
            <div id="conclusao" class="tab-content">
                <label for="status_de_conclusao">Status de Conclusão:</label>
                <input type="text" id="status_de_conclusao" name="status_de_conclusao" required>

                <label for="servidor_responsavel">Servidor Responsável:</label>
                <input type="text" id="servidor_responsavel" name="servidor_responsavel" required>

                <label for="infracao_artigo">Infração (Artigo):</label>
                <input type="text" id="infracao_artigo" name="infracao_artigo" required>

                <!-- Botão de envio -->
                <button type="submit" class="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        // Validação do lado do cliente (JavaScript)
        function validarCPF(cpf) {
            return /^[0-9]{11}$/.test(cpf);
        }

        function validarMatricula(matricula) {
            return /^[0-9]{16}$/.test(matricula);  // Deve conter 16 dígitos numéricos
        }

        function validarSomenteLetras(valor) {
            return /^[A-Za-zÀ-ÿ\s]+$/.test(valor);  // Apenas letras (acentuadas ou não) e espaços
        }

        // Função para validar o formulário no lado do cliente e exibir os erros como alertas
        function validarFormulario() {
            let erros = [];

            // Validação do CPF
            const cpf = document.getElementById('responsavel_ocor_cpf').value;
            if (!validarCPF(cpf)) {
                erros.push('O CPF deve conter exatamente 11 dígitos numéricos.');
            }

            // Validação da Matrícula
            const matricula = document.getElementById('estudante_mat').value;
            if (!validarMatricula(matricula)) {
                erros.push('A Matrícula do Estudante deve conter exatamente 16 dígitos numéricos.');
            }

            // Validação dos campos de texto que só aceitam letras
            const tipo = document.getElementById('tipo').value;
            const statusDeConclusao = document.getElementById('status_de_conclusao').value;
            const servidorResponsavel = document.getElementById('servidor_responsavel').value;

            if (!validarSomenteLetras(tipo)) {
                erros.push("O campo 'Tipo de Advertência' deve conter apenas letras.");
            }
            if (!validarSomenteLetras(statusDeConclusao)) {
                erros.push("O campo 'Status de Conclusão' deve conter apenas letras.");
            }
            if (!validarSomenteLetras(servidorResponsavel)) {
                erros.push("O campo 'Servidor Responsável' deve conter apenas letras.");
            }

            // Se houver erros, exibe-os como alertas
            if (erros.length > 0) {
                alert(erros.join('\n'));
                return false;  // Impede o envio do formulário
            }

            return true;  // Permite o envio do formulário
        }

        // Função para alternar entre abas
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";  // Esconde todas as abas
                tabcontent[i].classList.remove('active');
            }
            tablinks = document.getElementsByTagName("button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";  // Mostra a aba selecionada
            document.getElementById(tabName).classList.add('active');
            evt.currentTarget.className += " active";
        }

        // Esconder todas as abas, exceto a primeira, ao carregar a página
        document.addEventListener("DOMContentLoaded", function () {
            var tabcontent = document.getElementsByClassName("tab-content");
            for (var i = 1; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";  // Esconde todas as abas menos a primeira
            }
        });
    </script>

<a href="telaCae.php" class="button">Voltar para telaCae</a>
</body>

</html>