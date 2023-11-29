<<<<<<< HEAD
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

// Lógica para processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Recupere os valores do formulário
    $tipoOrdem = isset($_POST["tipo_ordem"]) ? $_POST["tipo_ordem"] : ''; // Verifica se o índice existe
    $valorCompra = isset($_POST["valor_compra"]) ? $_POST["valor_compra"] : '';
    $bonusOnus = isset($_POST["bonus_onus"]) ? $_POST["bonus_onus"] : '';

    // Insira os valores no banco de dados conforme necessário
    try {
        $sql = "INSERT INTO orders (type, status, time_gap, v_brl, v_btc, percentage, id_odr_trd) VALUES (:tipo_ordem, 'created', '24:00:00', :valor_compra, NULL, :bonus_onus, NULL)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tipo_ordem', $tipoOrdem);
        $stmt->bindParam(':valor_compra', $valorCompra);
        $stmt->bindParam(':bonus_onus', $bonusOnus);
        $stmt->execute();

        // Exemplo de saída, você pode redirecionar para outra página se desejar
        echo "Ordem criada com sucesso!";
        exit();
    } catch (PDOException $e) {
        echo "Erro ao inserir no banco de dados: " . $e->getMessage();
    }
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
    <link rel="stylesheet" href="../Design/Fonts/Satoshi/css/satoshi.css">
    <link rel="stylesheet" href="../Design/Fonts/Montserrat/Montserrat.css">
    <link rel="shortcut icon" href="../Design/Icons/Favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="custom">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <main>
    <div class="caixazona">
        <div class="lateralbox">
            <div class="menu-lateral">
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
                        <span>
                            Criar Ordem
                        </span>
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
        </div>

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
                    <p>Quanto você quer comprar/vender?</p>
                    <div class="input-group inputs d-flex justify-content-center my-4">
                        <input type="text" class="form-control" placeholder="Insira um valor" required
                            aria-label="Dollar amount (with dot and two decimal places)" name="valor_compra">
                        <span class="input-group-text divzinha"><img class="brasilf" src="brazil.png" alt="brazil flag">
                            R$</span>
                    </div>
                    <p>Bônus/Ônus sobre o mercado</p>
                    <div class="input-group inputs d-flex justify-content-center my-4">
                        <input type="text" class="form-control" placeholder="Insira um valor" required
                            aria-label="Dollar amount (with dot and two decimal places)" name="bonus_onus">
                        <span class="input-group-text divzinha"><p>%</p></span>
                    </div>
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
=======
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
>>>>>>> c0662c01e880321ee0e737ed79194b22ccd86035
