<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="page">
        <form method="POST" class="formCadastro" action="index.php">
            <h1>Cadastro</h1>
            <p>Preencha os campos abaixo para criar uma conta.</p>
            <label for="username"><i class="fa-solid fa-user"></i> Nome de Identificação</label>
            <div class="container-input1"></div>
                <input class="input-field" type="text" name="id_name" placeholder="Escreva seu nome de Identificação" required autofocus="true"/>
            <label for="username"><i class="fa-solid fa-user"></i> Nome de Exibição</label>
            <div class="container-input2"></div>
                <input class="input-field" type="text" name="pub_name" placeholder="Digite seu nome de exibição" required/>
            <label for="password"><i class="fa-solid fa-lock"></i> Senha</label>
            <div class="container-input6">
                <div class="show-password-toggle">
                    <input id="password" class="input-field" type="password" name="passwd" placeholder="Digite sua senha" required/>
                    <i id="togglePassword" class="show-password-icon far fa-eye-slash"></i>
                </div>    
            </div>
            <label for="password"><i class="fa-solid fa-lock"></i> Confirme a senha</label>
            <div class="container-input6">
                <div class="show-password-toggle">
                    <input id="confirmPassword" class="input-field" type="password" name="confirmpassword" placeholder="Repita a senha" required/>
                    <i id="toggleConfirmPassword" class="show-password-icon far fa-eye-slash"></i>
                </div>    
            </div>
            <a href="../LogIn/login.php">Já tem uma conta? Faça login</a>
            <input type="submit" value="Cadastrar" class="btn" />
        </form>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
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

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);

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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_name = $_POST["id_name"];
    $pub_name = $_POST["pub_name"];
    $passwd = $_POST["passwd"];
    $confirmpassword = $_POST["confirmpassword"];

    if ($passwd == $confirmpassword) {
        try {
            
            $host = "localhost"; 
            $dbname = "bipfix"; 
            $user = "root";
            $pass = "";

            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

            $check_sql = "SELECT * FROM account WHERE id_name = :id_name";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindParam(':id_name', $id_name);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                echo "Nome de usuário já está em uso. Escolha outro nome.";
            } else {
                // O nome de usuário é único, então insira o novo usuário no banco de dados
                $insert_sql = "INSERT INTO account (id_name, pub_name, passwd) VALUES (:id_name, :pub_name, :passwd)";
                $insert_stmt = $pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':id_name', $id_name);
                $insert_stmt->bindParam(':pub_name', $pub_name);
                $insert_stmt->bindParam(':passwd', $passwd);
                $insert_stmt->execute();

                echo "Cadastro realizado com sucesso!";

                header("Location: index.php"); // Substitua "index.php" pelo nome da sua página de confirmação
                exit; // Encerre o script após o redirecionamento
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
            var_dump($e); // Exibe informações detalhadas do erro
        }
        
    } else {
        echo "As senhas não coincidem.";
    }
}
?>


    
