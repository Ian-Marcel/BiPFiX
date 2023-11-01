<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="../Ícones/Fav.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>BiPFiX - Mercado</title>
</head>
<style>
    .button {
      background-color: #34C848;
      border: none;
      color: white;
      padding: 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border: 2px solid black;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      transition: 0.3 ease;
      cursor: pointer;
    }
    .button:hover{
        transform: scale(1.1);
        transition: .3s ease;
        cursor: pointer;
    }
    .h3coluna{
        border-bottom: 2px solid rgb(249, 249, 249);
        padding: 10px;
        border-left: 2px solid rgb(249, 249, 249);
        font-family: Montserrat;
        font-size: 15px;
    }
    .colunalabel{
        padding:10px;
        font-family: montserrat;
        border-radius: 15px; 
        padding: 10px; 
        background-color: rgba(30, 30, 30);
        font-size: 15px;
    }
    </style>
<body>
    <div class="caixaprincipal">
    <div style="border: 0px; background-color: #424A53;" class="menu-lateral">
        <ul>
        <li><a href="../Mais/" class="menu-item"><img src="../Ícones/Mais.png"></a></li>
            <li><a href="../Suas Ordens/" class="menu-item"><img src="../Ícones/Suas ordens.png"></a></li>
            <li><a href="../Criar Ordem" class="menu-item"><img src="../Ícones/Criar ordem.png"></a></li>
            <li><a href="#" class="menu-item"><img src="../Ícones/Mercado.png"></a><span style="font-family: montserrat; font-size: 15px; color:white; padding-top: 10px;">Mercado</span></li>
            <li><a href="../Conta/" class="menu-item"><img src="../Ícones/Conta.png"></a></li>
        </ul>
    </div>
    <div class="caixadomercado">
        <div class="mercadocima">
            <h3 style="font-family: montserrat;">Você deseja</h3>
            <button style="margin-left: 1vh; border-radius: 15px;" class="button">Comprar</button>
            <h3 style="font-family: montserrat; margin-left: 1vw; margin-right: 1vw;">ou</h3>
            <button style="background-color: #ff4e44; margin-left: 1vh; border-radius: 15px;" class="button">Vender</button>
                    <h3 style="font-family: montserrat; margin-left: 1vw;">?</h3>
        </div>
        <div class="mercadobaixo">
            <div class="colunas">
                <h3 class="h3coluna">Nome público</h3>
                <label class="colunalabel" id="nome_publico">MarcosSSB41</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Tipo da Ordem</h3>
                <label class="colunalabel" id="ordem">Venda</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Quantia</h3>
                <label class="colunalabel" id="quantia">300 - 800 R$</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Tempo de expiração</h3>
                <label style="color: black; background-color: #FFD700;" class="colunalabel" id="tempo_restante">11H49m</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Sats</h3>
                <label class="colunalabel" id="sats">90.000</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Bônus/Ônus</h3>
                <label style="background-color: #ff4e44;" class="colunalabel" id="bonus">- 20% Ônus</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Garantia</h3>
                <label class="colunalabel" id="garantia">3%</label>
            </div>
        </div>
        <div class="mercadobaixo">
            <div class="colunas">
                <h3 class="h3coluna">Nome público</h3>
                <label class="colunalabel" id="nome_publico">SafelyArmed</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Tipo da Ordem</h3>
                <label class="colunalabel" id="ordem">Compra</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Quantia</h3>
                <label class="colunalabel" id="quantia">150 - 200 R$</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Tempo de expiração</h3>
                <label style="color: black; background-color: #FFD700;" class="colunalabel" id="tempo_restante">12H23m</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Sats</h3>
                <label class="colunalabel" id="sats">23.000</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Bônus/Ônus</h3>
                <label style="background-color: #34C848;" class="colunalabel" id="bonus">15% Bônus</label>
            </div>
            <div class="colunas">
                <h3 class="h3coluna">Garantia</h3>
                <label class="colunalabel" id="garantia">3%</label>
            </div>
</div>

</body>
</html>