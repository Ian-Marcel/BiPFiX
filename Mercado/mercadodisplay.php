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
    global $pdo;

    try {
        $numBlocks = 4; 
        $sql = "SELECT * FROM orders WHERE status = 'created' AND type = :type LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':type', $orderType, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $numBlocks * 2, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $currentPage * $numBlocks * 2, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='status-markets'>";

        for ($j = 0; $j < 2; $j++) { 
            echo "<div class='market-row'>";

            for ($i = $j * $numBlocks; $i < ($j + 1) * $numBlocks; $i++) {
                echo "<div class='market-block'>";

                if ($i < count($orders)) {
                    $valorBRL = $orders[$i]['v_brl'];
                    $valorBTC = converterReaisParaSatoshis($valorBRL);

                    echo "<h3>Sats: {$valorBTC}</h3>";
                    echo "<h3>Valor em R$: {$valorBRL}</h3>";
                    echo "<h3>Bônus/Ônus: {$orders[$i]['percentage']}%</h3>";
                } else {
                    echo "<div class='empty-block'></div>";
                }

                echo "</div>";
            }

            echo "</div>"; 
        }
        
    } catch (PDOException $e) {
        echo "Erro ao obter as ordens do banco de dados: " . $e->getMessage();
    }
}

function converterReaisParaSatoshis($valorBRL) {
    $taxaDeConversao = 4; 

    $valorSatoshis = $valorBRL * 1e3 / $taxaDeConversao;

    return $valorSatoshis;
}
?>
