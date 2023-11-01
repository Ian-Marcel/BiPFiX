<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiPFiX - Log In</title>
    <link rel="shortcut icon" href="../Ícones/Fav.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<body>
    <div class="page">
        <form action="../Conta/" method="POST" class="formLogin">
        <h1>Login</h1>
        <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="username"><i class="fa-solid fa-user"></i> Nome de Identificação</label>
            <div class="container-input1">
                <input class="input-field" type="text" name="username" placeholder="Digite seu nome de identificação" required autofocus="true" />
            </div>
            <label for="password"><i class="fa-solid fa-lock"></i> Senha</label>
                <div class="show-password-toggle">
                    <input class="input-field" type="password" name="password" placeholder="Digite sua senha" required/>
                    <i class="show-password-icon far fa-eye-slash"></i>
                </div>    
            <a href="../Cadastro/">Ainda não tem conta? Cadastre-se</a>
            <input type="submit" value="Entrar" class="btn"/>
        </form>
    </div>
    <script>
        const passwordInput = document.querySelector('input[type="password"]');
        const showPasswordIcon = document.querySelector('.show-password-icon');

        showPasswordIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'text') {
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Conecte-se ao banco de dados usando o PDO (substitua as informações de conexão)
        $pdo = new PDO("mysql:host=localhost;dbname=bipfix1", "root", "");

        // Execute uma consulta para verificar o login (substitua pelos nomes reais das tabelas e colunas)
        $sql = "SELECT * FROM usuarios WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            echo "Login bem-sucedido!";
            // Aqui você pode redirecionar o usuário para a página principal
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
