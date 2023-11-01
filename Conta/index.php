<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="shortcut icon" href="../Ícones/Fav.ico" type="image/x-icon">
        <title>BiPFiX - Conta</title>
    </head>
    <body>
    <div class="tudo">
        <div class="gradient">
    <div class="largura">Bem vindo de volta Display Name!</div>
    <div class="caixazona">
    <div style="border: 0px; background-color: #424A53;" class="menu-lateral">
        <ul>
            <li><a href="../Mais/" class="menu-item"><img src="../Ícones/Mais.png"></a></li>
            <li><a href="../Suas Ordens/" class="menu-item"><img src="../Ícones/Suas ordens.png"></a></li>
            <li><a href="../Criar Ordem" class="menu-item"><img src="../Ícones/Criar ordem.png"></a></li>
            <li><a href="../Mercado/" class="menu-item"><img src="../Ícones/Mercado.png"></a></li>
            <li><a href="#" class="menu-item"><img src="../Ícones/Conta.png"></a><span style="font-family: montserrat; font-size: 15px; color:white; padding-top: 10px;">Conta</span></li>
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
            <img style="height: 200px; width: 200px;" src="https://cdn-icons-png.flaticon.com/512/7801/7801791.png">
            <h3 style="font-family: montserrat; font-size: 20px;">Você não tem nenhum tipo de ordem ativa no momento,<br>
                acesse o mercado de ordens para
                comprar ou vender.</h3>
        </div>
</div>

</body>
</html>
