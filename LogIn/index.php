<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - BiPFiX</title>
        <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
        <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
        <link rel="stylesheet" type="text/css" href="login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <body >
        <div class="banner"><section></section></div>
        <main>
            <form action="login.php" method="POST" class="formLogin">
            <h1>Entre na sua conta</h1>
                <label for="username"><i class="fa-solid fa-user"></i> Nome de Identificação</label>
                    <input class="input-field" type="text" name="id_name" placeholder="Digite seu nome de identificação" required autofocus="true" />
                </div>
                <label for="password"><i class="fa-solid fa-lock"></i> Senha</label>
                        <input class="input-field" type="password" name="passwd" placeholder="Digite sua senha" required/>
                <input type="submit" value="Entrar" class="btn"/>
                <a href="cadastro.php">Ainda não tem conta? Cadastre-se</a>
            </form>
        </main>
    </body>
</html>
<?php
session_start(); // Inicie a sessão (se ainda não estiver iniciada)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se as chaves do array existem
    $id_name = isset($_POST["id_name"]) ? $_POST["id_name"] : null;
    $passwd = isset($_POST["passwd"]) ? $_POST["passwd"] : null;

    try {
        // Conecte-se ao banco de dados usando o PDO (substitua as informações de conexão)
        $pdo = new PDO("mysql:host=localhost;dbname=bipfix", "root", "");

        // Execute uma consulta para verificar o login (substitua pelos nomes reais das tabelas e colunas)
        $sql = "SELECT * FROM account WHERE id_name = :id_name AND passwd = :passwd";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_name', $id_name);
        $stmt->bindParam(':passwd', $passwd);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Login bem-sucedido! Redirecione para a página principal
            $_SESSION['id_name'] = $id_name; // Defina o valor correto na sessão
            header("Location: ../Conta/index.php");
            exit(); // Certifique-se de encerrar o script após o redirecionamento
        } else {
            echo "Nome de usuário ou senha incorretos.";
        }
    } catch (PDOException $e) {
        echo "Erro na autenticação: " . $e->getMessage();
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>