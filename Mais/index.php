<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
    <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
    <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>BiPFiX - Mais</title>
</head>
<body>
    <div style="border: 0px; background-color: #424A53;" class="menu-lateral">
        <ul>
            <li>
                <a href="../Mais/" class="menu-item">
                    <img src="../Design/Icons/Dock/Mais.png">
                </a>
                <span>
                    Mais
                </span>
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
            </li>
            <li>
                <a href="../Conta/" class="menu-item">
                    <img src="../Design/Icons/Dock/Conta.png">
                </a>
            </li>
        </ul>
    </div>

<div class="container">
    <div class="faqbox">
        <div class="faq-item">
            <h4>O que é BiPFiX?</h4>
            <div class="textp">
                <p>
                    A BiPFiX propõe uma troca de pessoa para pessoa de BTC/R$ (Bitcoin para Real) baseada em Lightning. Ela simplifica o emparelhamento e minimiza a necessidade de confiança. BiPFiX foca na privacidade e na velocidade.
                </p>
            </div>
            <div class="outside">
                <div class="outinside">
                    <div class="textoutside">
                        <p class="poutside">Como funciona?</p>
                    </div>
                    <div class="icon"><i class="fa-solid fa-angle-down"></i></div>
                </div>
                <div class="textinside" style="display: none;">
                    <p>
                        AnonymousAlice01 quer vender bitcoin. Ela publica uma ordem de venda. BafflingBob02 quer comprar bitcoin e anota o pedido de Alice. Ambos precisam postar um pequeno vínculo usando um raio para provar que são robôs reais. Em seguida, Alice lança a garantia comercial também usando uma fatura relâmpago. RoboSats bloqueia a fatura até que Alice confirme que recebeu o decreto, então os satoshis são liberados para Bob. Aproveite seus satoshis, Bob!
                    </p>
                    <br>
                    <p>
                        Em nenhum momento, AnonymousAlice01 e BafflingBob02 precisam confiar os fundos de bitcoin um ao outro. Caso haja um conflito, a equipe da BiPFiX ajudará a resolver a disputa. Você pode encontrar uma descrição passo a passo do pipeline comercial em Como funciona. Você também pode conferir o guia completo em Como usar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(".faq-item").click(function (event) {
        var container = $(this);
        var answer = container.find(".textinside");

        if (container.hasClass("expanded")) {
            if (!$(event.target).closest(".textinside").length) {
                answer.slideUp();
                container.removeClass("expanded");
                container.find(".icon i").removeClass("fa-rotate-180");
            }
        } else {
            answer.slideDown();
            container.addClass("expanded");
            container.find(".icon i").addClass("fa-rotate-180");
        }
    });
});
</script>

</body>
</html>
