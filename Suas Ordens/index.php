<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="suasordens.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="shortcut icon" href="../Ícones/Fav.ico" type="image/x-icon">
        <title>BiPFiX - Suas Ordens</title>
    </head>
    <body>
    <div class="tudo">
        <div class="gradient">
    <div class="largura">Bem vindo de volta Display Name!</div>
    <div class="caixazona">
    <div style="border: 0px; background-color: #424A53;" class="menu-lateral">
        <ul>
        <li><a href="../Mais/" class="menu-item"><img src="../Ícones/Mais.png"></a></li>
            <li><a href="#" class="menu-item"><img src="../Ícones/Suas ordens.png"></a><span style="font-family: montserrat; font-size: 15px; color:white; padding-top: 10px;">Suas Ordens</span></li>
            <li><a href="../Criar Ordem" class="menu-item"><img src="../Ícones/Criar ordem.png"></a></li>
            <li><a href="../Mercado/" class="menu-item"><img src="../Ícones/Mercado.png"></a></li>
            <li><a href="../Conta/" class="menu-item"><img src="../Ícones/Conta.png"></a></li>
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
            <div class="caixaordens"><a  class="ordensbutton">Compra</a>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Querendo:</p>
                    <h3 style="margin-top: 30%; color: white;">20.000 Sats</h3>
                </div>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Por:</p>
                    <h3 style="margin-top: 46%; color: white;">R$ 30,47</h3>
                </div>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Expirará</p>
                    <div class="tempo"><p style="margin-top: 30%; border-radius: 10px; background-color: white; padding: 5px; color: #34C848;">24H</p></div>
                </div>
            </div>
            <div class="caixaordens"><a style="background-color: #FF6961;" class="ordensbutton">Venda</a>
                <div class="ordenscolunas"><p style=" margin-top: 10%; margin-left: 10px; color: white;">Ofertando:</p>
                    <h3 style="margin-top: 30%; color: white;">20.000 Sats</h3>
                </div>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Por:</p>
                    <h3 style="margin-top: 46%; color: white;">R$ 30,47</h3>
                </div>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Expirará</p>
                    <div style="background-color: #FFD700;" class="tempo"><p style="margin-top: 30%; border-radius: 10px; background-color: white; padding: 5px; color: #FFD700;">8H</p></div>
                </div>
            </div>
            <div class="caixaordens"><a style="background-color: #FF6961;" class="ordensbutton">Venda</a>
                <div class="ordenscolunas"><p style=" margin-top: 10%; margin-left: 10px; color: white;">Ofertando:</p>
                    <h3 style="margin-top: 30%; color: white;">20.000 Sats</h3>
                </div>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Por:</p>
                    <h3 style="margin-top: 46%; color: white;">R$ 30,47</h3>
                </div>
                <div class="ordenscolunas"><p style="margin-top: 10%; margin-left: 10px; color: white;">Expirará</p>
                    <div style="background-color: #ff6a00;" class="tempo"><p style="margin-top: 30%; border-radius: 10px; background-color: white; padding: 5px; color: #FF6961;">5H</p></div>
                </div>
            </div>
        </div>
</div>

</body>
</html>
