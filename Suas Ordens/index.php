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
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="suasordens.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
    <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
    <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
        <title>BiPFiX - Suas Ordens</title>
    </head>
    <body>
    <div class="tudo">
        <div class="gradient">
    <div class="largura"><h2>Olá, <?php echo $idName; ?>, suas ordens aparecerão aqui!</h2></div>
    <div class="caixazona">
    <div style="border: 0px; background-color: #424A53;" class="menu-lateral">
        <ul>
            <li>
                <a href="../Mais/" class="menu-item">
                    <img src="../Design/Icons/Dock/Mais.png">
                </a>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <img src="../Design/Icons/Dock/Suas ordens.png">
                </a>
                <span style="font-family: montserrat; font-size: 15px; color:white; padding-top: 10px;">
                    Suas Ordens
                </span>
            </li>
            <li>
                <a href="../Criar Ordem" class="menu-item">
                    <img src="../Design/Icons/Dock/Criar ordem.png">
                </a>
            </li>
            <li>
                <a href="../Mercado/" class="menu-item">
                    <img src="../Design/Icons/Dock/Mercado.png">
                </a>
            </li>
            <li>
                <a href="../Conta/" class="menu-item">
                    <img src="../Design/Icons/Dock/Conta.png">
                </a>
            </li>
        </ul>
    </div>
    <div class="caixazonadireita">
        <div class="detalhescontainer"><!--Começa o código da parte de detalhes da conta e suas ordens-->
            <div style="background-color: rgb(59, 59, 59);" class="setor">
                <div style="font-size: 40px;" class="texto">Detalhes da conta</div>
                <div class="texto" style="font-size: 20px; margin-top: 20px;">ID:</div>
                <label for="id"></label>
                <input type="text" name="id"  required>
                <label for="nomepublico"><b style="font-family: montserrat; padding-top: 50px;">Nome Público:</b></label>
                <input type="text" name="nomepublico" required>
                <div class="texto" style="font-size: 20px;">Senha:</div>
                <label for="senha"></label>
                <input type="password" name="senha"  required>
            </div>
        </div><!--Termina o código da parte de detalhes da conta e suas ordens-->
        <div class="ordens">
            <div style="font-size: 40px;" class="texto">Suas ordens</div>
            <?php
            // Inclua aqui a lógica de conexão com o banco de dados, se necessário
            $host = "localhost";
            $dbname = "bipfix";
            $user = "root";
            $pass = "";

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erro na conexão com o banco de dados: " . $e->getMessage();
                die();
            }

            // Lógica para obter ordens do usuário logado
            $userIdentificador = isset($_SESSION['id_name']) ? $_SESSION['id_name'] : '';

            if ($userIdentificador) {
                $sql = "SELECT * FROM orders WHERE user_identifier = :user_identifier";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_identifier', $userIdentificador);
                $stmt->execute();
                $ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($ordens) {
                    // Se o usuário tiver ordens
                    foreach ($ordens as $ordem) {
                        $tipoOrdem = ucfirst($ordem['type']);
                        $corBotao = ($tipoOrdem == 'Compra') ? 'compra' : 'venda';
                        echo '<div class="caixaordens">';
                        echo '<a class="ordensbutton">' . $tipoOrdem . '</a>';
                        echo '<div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Bônus/Ônus</p>';
                        echo '<h3 style=" color: white;">' . $ordem['percentage'] . '%'. '</h3>';
                        echo '</div>';
                        echo '<div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Por:</p>';
                        echo '<h3 style=" color: white;">R$' . $ordem['v_brl'] . '</h3>';
                        echo '</div>';
                        echo '<div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Apague:</p>';
                        
                        // Botão para apagar a ordem
                        echo '<div class="botão2">';
                        echo '<a class="botão2 ' . ($ordem['type'] == 'compra' ? 'compra' : 'venda') . '" onclick="confirmarExclusao(' . $ordem['id_order'] . ')">';
                        echo '<i class="fa-solid fa-trash-can" style="color: white; display: flex; text-align:center; align-items: center; justify-content: center; font-size: 24px;"></i>';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // Se o usuário não tiver ordens
                    echo '<p style="font-size: 20px; color: white;">Você não possui ordens ativas.</p>';
                }
            }
                ?>
        </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ordensButtons = document.querySelectorAll('.ordensbutton');

        ordensButtons.forEach(function(button) {
            var tipoOrdem = button.innerText.trim().toLowerCase();

            if (tipoOrdem === 'compra') {
                button.style.backgroundColor = '#34C848';
                button.style.color = '#fff';
            } else if (tipoOrdem === 'venda') {
                button.style.backgroundColor = '#E74C3C';
                button.style.color = '#fff';
            }
        });
    });

    function confirmarExclusao(idOrdem) {
        var confirmacao = confirm("Tem certeza de que deseja excluir esta ordem?");
        if (confirmacao) {
            // Redireciona para o arquivo PHP que processa a exclusão
            window.location.href = 'excluir_ordem.php?id=' + idOrdem;
        }
    }
</script>
</body>
</html>
