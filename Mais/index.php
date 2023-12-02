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
    <!-- DOCK MENU -->
        <header id="dock">
            <nav class="dock">
                <ul>
                    <li>
                        <a href="../Mais/" class="APP" title="Mais">
                            <img src="../Design/Icons/Dock/Mais.png" alt="MaisIMG">
                        </a>
                        <span>Mais</span>
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
                    </li>
                </ul>
            </nav>
        </header>

    <!-- CONTEUDO -->
        <div class="container">
            <div class="faqbox">
                <div class="faq-item">
                    <h3>O que é BiPFiX?</h3>
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
                                AnonymousAlice01 quer vender bitcoin. Ela publica uma ordem de venda. BafflingBob02 quer comprar bitcoin e anota o pedido de Alice. Ambos precisam postar um pequeno vínculo usando um raio para provar que são robôs reais. Em seguida, Alice lança a garantia comercial também usando uma fatura relâmpago. BiPFiX bloqueia a fatura até que Alice confirme que recebeu o decreto, então os satoshis são liberados para Bob. Aproveite seus satoshis, Bob!
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
