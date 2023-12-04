<?php
session_start(); // Certifique-se de iniciar a sessão no início do script

if (!isset($_SESSION['id_name'])) {
    header("Location: ../LogIn/");
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
                        <span>Suas Ordens</span>
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
                    </li>
                </ul>
            </nav>
        </header>


    <!-- INFORMAÇÕES DA SUAS ORDENS -->
        <div class="ordens">
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
                    foreach ($ordens as $ordem) {
                        $tipoOrdem = ucfirst($ordem['type']);
                        $corBotao = ($tipoOrdem == 'Compra') ? 'compra' : 'venda';
                        echo '<div class="caixaordens">';
                                echo '<h3 class="ordensbutton">' . $tipoOrdem . '</h3>';
                                echo '<span>Valor de R$' . $ordem['v_brl'] . '</span>';
                                echo '<span> A ' .$ordem['percentage']. '% do mercado</span>';
                                echo '<span>R$ ' . $ordem['v_brl'] . " = " . round($ordem['v_brl'] / 190000 * 100000000) . ' Sats</span> </br>' ;
                            // Botão para apagar a ordem
                                echo '<a class="botão2 ' . ($ordem['type'] == 'compra' ? 'compra' : 'venda') . '" onclick="confirmarExclusao(' . $ordem['id_order'] . ')">';
                                echo '<span>Apagar Ordem</span>';
                                echo '</a>';
                        echo '</div>';
                    }
                } else {
                    // Se o usuário não tiver ordens
                    echo '<p style="font-size: 20px; color: white;">Você não possui ordens ativas.</p>';
                }
            }
                ?>
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
