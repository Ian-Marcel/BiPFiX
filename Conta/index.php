<?php
session_start(); // Certifique-se de iniciar a sessão no início do script

if (!isset($_SESSION['id_name'])) {
    header("Location: ../LogIn/login.php");
    exit();
}

$userId = $_SESSION['id_name'];

// Conecte-se ao banco de dados (substitua as informações de conexão)
$host = "localhost";
$dbname = "bipfix";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Consulte o banco de dados para obter informações do usuário
    $sql = "SELECT id_name, pub_name FROM account WHERE id_name = :id_name";  // Corrigido aqui
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_name', $userId);
    $stmt->execute();

    // Verifique se a consulta foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $idName = $userData['id_name'];
        $pubName = $userData['pub_name'];
    } else {
        $idName = "Usuário não encontrado"; // Adicione uma mensagem padrão
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

// Processar a alteração do nome público
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["changepubname"])) {
    $newPubName = $_POST["changepubname"];

    // Atualizar o nome público no banco de dados
    $updatePubNameSql = "UPDATE account SET pub_name = :newPubName WHERE id_name = :userId";
    $updatePubNameStmt = $pdo->prepare($updatePubNameSql);
    $updatePubNameStmt->bindParam(':newPubName', $newPubName);
    $updatePubNameStmt->bindParam(':userId', $userId);

    if ($updatePubNameStmt->execute()) {
        // Atualização bem-sucedida
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar o nome público.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["changepasswd"])) {
    $newPassword = $_POST["changepasswd"];

    // Atualizar a senha no banco de dados (mantendo como texto simples)
    $updatePasswordSql = "UPDATE account SET passwd = :newPassword WHERE id_name = :userId";
    $updatePasswordStmt = $pdo->prepare($updatePasswordSql);
    $updatePasswordStmt->bindParam(':newPassword', $newPassword);
    $updatePasswordStmt->bindParam(':userId', $userId);

    if ($updatePasswordStmt->execute()) {
        // Atualização bem-sucedida
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar a senha.";
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
        <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
        <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
        <title>BiPFiX - Conta</title>
    </head>
    <body>
    <!-- DOCK MENU -->
        <header id="dock">
            <nav class="dock">
                <ul>
                    <li>
                        <a href="../Mais/" class="APP" title="Mais">
                            <img src="../Design/Icons/Dock/Mais.png" alt="MaisIMG">
                        </a>
                    </li>
                    <li>
                        <a href="../Suas Ordens/" class="APP" title="Suas Ordens">
                            <img src="../Design/Icons/Dock/Suas ordens.png" alt="Suas_OrdensIMG">
                        </a>
                    </li>
                    <li>
                        <a href="../Criar Ordem/" class="APP" title="Criar Ordem">
                            <img src="../Design/Icons/Dock/Criar ordem.png" alt="Criar_OrdemIMG">
                        </a>
                    </li>
                    <li>
                        <a href="../Mercado/" class="APP" title="Mercado">
                            <img src="../Design/Icons/Dock/Mercado.png" alt="MercadoIMG">
                        </a>
                    </li>
                    <li>
                        <a href="../Conta/" class="APP" title="Conta">
                            <img src="../Design/Icons/Dock/Conta.png" alt="ContaIMG">
                        </a>
                        <span>Conta</span>
                    </li>
                </ul>
            </nav>
        </header>
    <!-- INFORMAÇÕES DA CONTA -->
        <main>
    <h1>Olá, <?php echo $idName; ?></h1>
            <section>
    <h3>Informações da conta</h3>
                <div>
                    <div class="show_username">
                        <label>Nome de usuário</label>
                        <span><?php echo $idName; ?></span>
                    </div>
                    <form action="index.php" method="post">
                        <label for="changepubname">Nome público</label>
                        <br>
                        <input type="text" name="changepubname" id="change_pub_name">
                        <input type="submit" value="change">
                    </form>
                    <form action="index.php" method="post">
                    <label for="changepasswd">Senha</label>
                    <br>
                        <input type="text" name="changepasswd" id="change_passwd">
                        <input type="submit" value="change">
                    </form>
                </div>
                <a id="logingOUT" href="../LogIn/">
                    <img src="../Design/Icons/Dock/Logout.png" alt="logoutIMG">
                    <span>Log Out</span>
                </a>
            </section>
        </main>
    </body>
</html>