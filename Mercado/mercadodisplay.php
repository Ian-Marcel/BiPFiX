<?php
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

function displayOrders($orderType, $currentPage) {
    global $pdo; // Adiciona esta linha para tornar $pdo global dentro da função

    try {
        // Exibir as ordens em duas colunas de quatro blocos
        $numBlocks = 4; // Número de blocos por coluna

        // Consulta para obter as ordens do banco de dados
        $sql = "SELECT * FROM orders WHERE status = 'created' AND type = :type LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':type', $orderType, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $numBlocks * 2, PDO::PARAM_INT); // Exibe o dobro para lidar com duas colunas
        $stmt->bindValue(':offset', $currentPage * $numBlocks * 2, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Abre a div de status-markets fora dos loops
        echo "<div class='status-markets'>";

        for ($j = 0; $j < 2; $j++) { // Duas colunas
            echo "<div class='market-row'>";

            for ($i = $j * $numBlocks; $i < ($j + 1) * $numBlocks; $i++) {
                echo "<div class='market-block'>";

                if ($i < count($orders)) {
                    echo "<h3>Sats: {$orders[$i]['v_btc']}</h3>";
                    echo "<h3>Valor em R$: {$orders[$i]['v_brl']}</h3>";
                    echo "<h3>Bônus/Ônus: {$orders[$i]['percentage']}%</h3>";
                } else {
                    // Adicione uma classe para estilizar visualmente os blocos vazios
                    echo "<div class='empty-block'></div>";
                }

                echo "</div>";
            }

            echo "</div>"; // Fecha a div de market-row para cada coluna
        }

        // Fecha a div de status-markets fora dos loops
        echo "</div>";

    } catch (PDOException $e) {
        echo "Erro ao obter as ordens do banco de dados: " . $e->getMessage();
    }
}