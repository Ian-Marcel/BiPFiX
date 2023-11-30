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

// Lógica para verificar e excluir ordens expiradas
try {
    session_start(); // Inicie a sessão

    // Verifique se $_SESSION['id_name'] está definido antes de usá-lo
    if (!isset($_SESSION['id_name'])) {
        echo "Erro: Sessão não iniciada ou id_name não definido.";
        exit();
    }

    $id_name = $_SESSION['id_name'];

    $sql = "SELECT id, time_gap FROM orders WHERE user_identifier = :id_name AND status = 'created'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_name', $id_name);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as $order) {
        $orderId = $order['id'];
        $timeGap = $order['time_gap'];
        $userIdentifier = $order['user_identifier']; // Adicionado o user_identifier

        // Calcula o tempo restante em segundos
        $timeGapInSeconds = strtotime($timeGap) - time();

        if ($timeGapInSeconds <= 0) {
            // A ordem expirou, exclua-a
            $deleteSql = "DELETE FROM orders WHERE id = :orderId AND user_identifier = :userIdentifier";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->bindParam(':orderId', $orderId);
            $deleteStmt->bindParam(':userIdentifier', $userIdentifier);
            $deleteStmt->execute();
        } else {
            // Formata o tempo restante para o formato 'HH:MM:SS'
            $newTimeGap = gmdate("H:i:s", $timeGapInSeconds);

            // Atualize o time_gap restante
            $updateSql = "UPDATE orders SET time_gap = :newTimeGap WHERE id = :orderId AND user_identifier = :userIdentifier";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':newTimeGap', $newTimeGap);
            $updateStmt->bindParam(':orderId', $orderId);
            $updateStmt->bindParam(':userIdentifier', $userIdentifier);
            $updateStmt->execute();
        }
    }
} catch (PDOException $e) {
#    echo "Erro ao verificar e excluir ordens expiradas: " . $e->getMessage();
}

// Lógica para processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Recupere os valores do formulário
    $tipoOrdem = isset($_POST["tipo_ordem"]) ? $_POST["tipo_ordem"] : ''; 
    $valorCompra = isset($_POST["valor_compra"]) ? $_POST["valor_compra"] : '';
    $bonusOnus = isset($_POST["bonus_onus"]) ? $_POST["bonus_onus"] : '';

    // Obtém o id_name do usuário atual (você pode ajustar essa lógica conforme necessário)
    $id_name = $_SESSION['id_name']; // ou qualquer outra lógica para obter o id_name do usuário

    try {
        // Consulta para obter o user_identifier com base no id_name do usuário
        $getUserIdentifierSql = "SELECT id_name FROM account WHERE id_name = :id_name";
        $getUserIdentifierStmt = $pdo->prepare($getUserIdentifierSql);
        $getUserIdentifierStmt->bindParam(':id_name', $id_name);
        $getUserIdentifierStmt->execute();

        if ($getUserIdentifierStmt->rowCount() == 1) {
            $userIdentifier = $id_name; // ou qualquer valor relacionado ao id_name do usuário
        } else {
            // Trate o caso em que o id_name não foi encontrado
            echo "Erro ao obter o id_name do usuário.";
            exit();
        }

        // Insira os valores no banco de dados conforme necessário
        $insertOrderSql = "INSERT INTO orders (user_identifier, type, status, time_gap, v_brl, v_btc, percentage, id_odr_trd) VALUES (:user_identifier, :tipo_ordem, 'created', '24:00:00', :valor_compra, NULL, :bonus_onus, NULL)";
        $insertOrderStmt = $pdo->prepare($insertOrderSql);
        $insertOrderStmt->bindParam(':user_identifier', $userIdentifier);
        $insertOrderStmt->bindParam(':tipo_ordem', $tipoOrdem);
        $insertOrderStmt->bindParam(':valor_compra', $valorCompra);
        $insertOrderStmt->bindParam(':bonus_onus', $bonusOnus);
        $insertOrderStmt->execute();

        // Exemplo de saída, você pode redirecionar para outra página se desejar
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao inserir no banco de dados: " . $e->getMessage();
    }
}

// Exiba a mensagem somente após a inserção bem-sucedida ou quando o formulário for enviado pela primeira vez
if (isset($_POST["submit"])) {
    $tipo_ordem = $_POST['tipo_ordem'];
    $valor_compra = isset($_POST['valor_compra']) ? $_POST['valor_compra'] . ' R$' : '0 R$';
    $bonus_onus = isset($_POST['bonus_onus']) ? $_POST['bonus_onus'] . '%' : '0%';

    echo "<p style='margin-top: 60px !important;'>Você está criando uma ordem de $tipo_ordem de $valor_compra a uma taxa de $bonus_onus</p>";
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiPFiX - Criar Ordem</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="createorder.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
    <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
    <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="custom">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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
                        <span>Criar Ordem</span>
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

    <main>

        <div class="criar">
        <form action="index.php" method="post">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="tipoOrdemBtn">
                        Compra
                    </button>
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item verde" type="button" onclick="changeTipoOrdem('Compra')">Compra</button></li>
                        <li><button class="dropdown-item vermelho" type="button" onclick="changeTipoOrdem('Venda')">Venda</button></li>
                    </ul>
                    <input type="hidden" name="tipo_ordem" id="tipo_ordem_input" value="Compra">
                </div>
                <div class="container-fluid container1 my-5">
                    <p>Quanto você quer <span id="acao_compra_venda">comprar</span>?</p>
                    <div class="input-group inputs d-flex justify-content-center my-4">
                        <input type="number" class="form-control" placeholder="Insira um valor" required
                            aria-label="Dollar amount (with dot and two decimal places)" name="valor_compra" min="1">
                        <span class="input-group-text divzinha">R$</span>
                    </div>
                    <p>Bônus/Ônus sobre o mercado</p>
                    <div class="input-group inputs d-flex justify-content-center my-4">
                        <input type="number" class="form-control" placeholder="Insira um valor" required
                            aria-label="Dollar amount (with dot and two decimal places)" name="bonus_onus" min="-20" max="20">
                        <span class="input-group-text divzinha"><p>%</p></span>
                    </div>
                    <p id="mensagem-ordem" style='margin-top: 60px !important;'>Você está criando uma ordem de Compra de 0 R$ a uma taxa de 0%</p>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tipo_ordem'])) {
                        $tipo_ordem = $_POST['tipo_ordem'];
                        $valor_compra = isset($_POST['valor_compra']) ? $_POST['valor_compra'] . ' R$' : '0 R$';
                        $bonus_onus = isset($_POST['bonus_onus']) ? $_POST['bonus_onus'] . '%' : '0%';
                        echo "<p style='margin-top: 60px !important;'>Você está criando uma ordem de $tipo_ordem de $valor_compra a uma taxa de $bonus_onus</p>";
                    }
                    ?>
                    <div class="divbotão my-4">
                        <input type="submit" name="submit" class="botão" value="Criar Ordem">
                    </div>
                    <p class="p1">Valor desses bitcoins no mercado: 130.000 R$/BTC</p>
                </div>
            </form>
            <a class="botão2" onclick="limparFormulario()"><i class="fa-solid fa-trash-can"></i></a>
        </div>
    </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var tipoOrdemBtn = document.getElementById('tipoOrdemBtn');
        var dropdownMenu = tipoOrdemBtn.nextElementSibling;

        tipoOrdemBtn.addEventListener('click', function (event) {
            event.stopPropagation(); // Impede a propagação do evento para o documento

            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function (event) {
            if (!tipoOrdemBtn.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
        // Adicione este bloco de código
        var valorCompraInput = document.querySelector('input[name="valor_compra"]');
        var bonusOnusInput = document.querySelector('input[name="bonus_onus"]');
        var mensagemOrdem = document.getElementById('mensagem-ordem');

        valorCompraInput.addEventListener('input', atualizarMensagemOrdem);
        bonusOnusInput.addEventListener('input', atualizarMensagemOrdem);

        function atualizarMensagemOrdem() {
        var tipoOrdem = document.getElementById('tipoOrdemBtn').innerText;
        var valorCompra = valorCompraInput.value || '0';
        var bonusOnus = bonusOnusInput.value || '0';

        // Altere o texto dentro do <span> em vez de dentro do <label>
        var acaoCompraVenda = document.getElementById('acao_compra_venda');
        acaoCompraVenda.innerText = tipoOrdem.toLowerCase();
        mensagemOrdem.innerText = `Você está criando uma ordem de ${acaoCompraVenda.innerText} de ${valorCompra} R$ a uma taxa de ${bonusOnus}%`;
    }
    });

    function changeTipoOrdem(tipo) {
        var tipoOrdemBtn = document.getElementById('tipoOrdemBtn');
        tipoOrdemBtn.innerText = tipo;
        tipoOrdemBtn.className = tipo === 'Compra' ? 'btn dropdown-toggle verde' : 'btn dropdown-toggle vermelho';

        // Definir o valor do tipo de ordem em um campo oculto
        document.getElementById('tipo_ordem_input').value = tipo;

        // Fechar manualmente o dropdown após selecionar
        var dropdownMenu = tipoOrdemBtn.nextElementSibling;
        dropdownMenu.classList.remove('show');
    }

    function limparFormulario() {
        document.querySelector('form').reset();
        changeTipoOrdem('Compra');
    }
    </script>
</body>
</html>
