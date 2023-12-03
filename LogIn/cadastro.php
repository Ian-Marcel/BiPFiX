<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
        <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="cadastro.css">
</head>
<!-- style="background-color: #000000;"-->
<body>
    <div class="banner"><section></section></div>
    <main>
        <h1>Crie sua conta</h1>
        <form method="POST" class="formCadastro" action="cadastro.php">
                <label for="username"><i class="fa-solid fa-user"></i> Nome de Identificação</label>
                    <input class="input-field" type="text" name="id_name" placeholder="Escreva seu nome de Identificação" required autofocus="true"/>
                <label for="username"><i class="fa-solid fa-user"></i> Nome de Exibição</label>
                    <input class="input-field" type="text" name="pub_name" placeholder="Digite seu nome de exibição" required/>
                <label for="password"><i class="fa-solid fa-lock"></i> Senha</label>
                        <input id="password" class="input-field" type="password" name="passwd" placeholder="Digite sua senha" required/>
                </div>
                <input type="submit" value="Cadastrar" class="btn" />
                <a href="../LogIn/">Já tem uma conta? Faça login</a>
            </form>
    </main
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

                header("Location: cadastro.php"); // Substitua "cadastro.php" pelo nome da sua página de confirmação
                exit; // Encerre o script após o redirecionamento
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
            var_dump($e); // Exibe informações detalhadas do erro
        }
    
}
?>
