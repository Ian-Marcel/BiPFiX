<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mercado.css">
    <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
    <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
    <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>BiPFiX - Mercado</title>
</head>
<body>
    <div class="caixaprincipal">
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
                <span style="color: white;">
                    Mercado
                </span>
            </li>
            <li>
                <a href="../Conta/" class="menu-item">
                    <img src="../Design/Icons/Dock/Conta.png">
                </a>
            </li>
        </ul>
    </div>
    <div class="conteudo-centralizado">
        <div class="mercado-status">
            <div style="background-color: #34C848" class="status-box">
                <div class="status-header">
                    <h2>Você está:</h2>
                    <h1>COMPRANDO</h1>
                </div>
            </div>
        </div>
        <div class="status-markets">
            <div class="market-row">
            <?php include 'mercadodisplay.php';
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 0;
                displayOrders('Compra', $currentPage);
            ?>
            </div>
        </div>
        <div  class="pagination">
        <?php if ($currentPage > 0): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>">Página Anterior</a>
        <?php endif; ?>
            <a href="?page=<?php echo $currentPage + 1; ?>">Próxima Página</a>
        </div>
    </div>
</div>
</body>
</html>
