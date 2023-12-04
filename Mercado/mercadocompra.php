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
</body>
</html>
