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

try {
    // Consulta para obter as ordens do banco de dados
    $sql = "SELECT * FROM orders WHERE status = 'created'";
    $stmt = $pdo->query($sql);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Exibir as ordens em dois conjuntos de quatro blocos
    $numBlocks = 4; // Número de blocos por coluna

    for ($j = 0; $j < 1; $j++) { // Duas colunas
        echo "<div class='market-row'>"; // Use 'market-column' para separar as colunas

        for ($i = $j * $numBlocks; $i < ($j + 1) * $numBlocks; $i++) {
            echo "<div class='market-block'>";

            if ($i < count($orders)) {
                echo "<h3>Sats: {$orders[$i]['v_btc']}</h3>";
                echo "<h3>Valor em R$: {$orders[$i]['v_brl']}</h3>";
                echo "<h3>Bônus/Ônus: {$orders[$i]['percentage']}%</h3>";
            } else {
                // Adicione uma classe para estilizar visualmente os blocos vazios
                echo "";
            }

            echo "</div>";
        }

        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Erro ao obter as ordens do banco de dados: " . $e->getMessage();
}
?>
