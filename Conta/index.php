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
    <h1>Olá, $USER</h1>
            <section>
    <h3>Informações da conta</h3>
                <div>
                    <div class="show_username">
                        <label>Nome de usuário</label>
                        <span>$USER</span>
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