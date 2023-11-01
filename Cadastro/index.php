<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiPFiX - Cadastro</title>
    <link rel="shortcut icon" href="../Ícones/Fav.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="page">
        <form method="POST" class="formCadastro" action="cadastro.php">
        <h1>Cadastro</h1>
        <p>Preencha os campos abaixo para criar uma conta.</p>
            <label for="username"><i class="fa-solid fa-user"></i> Nome de Identificação</label>
            <div class="container-input1"></div>
                <input class="input-field" type="text" name="username" placeholder="Escreva seu nome de Identificação" required autofocus="true"/>
            <label for="username"><i class="fa-solid fa-user"></i> Nome de Exibição</label>
            <div class="container-input2"></div>
                <input class="input-field" type="text" name="displayname" placeholder="Digite seu nome de exibição" required/>
            <label for="password"><i class="fa-solid fa-lock"></i> Senha</label>
            <div class="container-input6">
                <div class="show-password-toggle">
                    <input class="input-field" type="password" name="password" placeholder="Digite sua senha" required/>
                    <i class="show-password-icon far fa-eye-slash"></i>
                </div>    
            </div>
            <label for="password"><i class="fa-solid fa-lock"></i> Confirme a senha</label>
            <div class="container-input6">
                <div class="show-password-toggle">
                    <input class="input-field" type="password" name="confirmpassword" placeholder="Repita a senha" required/>
                    <i class="show-password-icon far fa-eye-slash"></i>
                </div>    
            </div>
            <a href="/LogIn/">Já tem uma conta? Faça login</a>
            <input type="submit" value="Cadastrar" class="btn" />
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
    $displayname = $_POST["displayname"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Verifique se as senhas coincidem
    if ($password == $confirmpassword) {
        try {
            // Conecte-se ao banco de dados usando o PDO
            $host = "localhost"; // Host do banco de dados
            $dbname = "bipfix1"; // Nome do banco de dados
            $user = "root"; // Nome de usuário do banco de dados
            $pass = ""; // Senha do banco de dados

            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

            // Verifique se o nome de usuário já existe
            $check_sql = "SELECT * FROM usuarios WHERE username = :username";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindParam(':username', $username);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                echo "Nome de usuário já está em uso. Escolha outro nome.";
            } else {
                // O nome de usuário é único, então insira o novo usuário no banco de dados
                $insert_sql = "INSERT INTO usuarios (username, displayname, password) VALUES (:username, :displayname, :password)";
                $insert_stmt = $pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':username', $username);
                $insert_stmt->bindParam(':displayname', $displayname);
                $insert_stmt->bindParam(':password', $password);
                $insert_stmt->execute();

                echo "Cadastro realizado com sucesso!";

                header("Location: cadastro.php"); // Substitua "confirmacao.php" pelo nome da sua página de confirmação
                exit; // Encerre o script após o redirecionamento
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    } else {
        echo "As senhas não coincidem.";
    }
}

?>


    
