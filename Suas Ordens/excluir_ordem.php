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

// Verifique se o ID da ordem foi passado pela URL
if (isset($_GET['id'])) {
    $idOrdem = $_GET['id'];

    // Prepare a declaração SQL para excluir a ordem
    $sql = "DELETE FROM orders WHERE id_order = :idOrdem";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idOrdem', $idOrdem);

    try {
        // Execute a declaração SQL
        $stmt->execute();

        // Redirecione de volta para a página de ordens
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao excluir a ordem: " . $e->getMessage();
    }
} else {
    echo "ID da ordem não fornecido.";
}
?>
