<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BiPFiX - Criar Ordem</title>
        <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
        <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
        <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="style.css">
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

    <!-- FORMULÁRIO DE CRIAÇÃO DE ORDEM -->
    <main>
        <h2>Crie sua ordem</h2>
        <form action="../Suas Ordens/" method="post">
                <select name="type" id="type">
                    <option value="buy">comprar</option>
                    <option value="sell">vender</option>
                </select>
                <p>Quantos</p>
                <input type="number" name="value_BRL" id="value_BRL" min="1">
                <p></p>
                <input type="number" name="percentage" id="percentage" min="1" max="20">
        </form>
    </main>

    </body>
</html>