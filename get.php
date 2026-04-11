<?php
// get.php - отдаёт товары в формате JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // для CORS, если нужно

include_once "pdo.php";

try {
    $db = new DB();
    $pdo = $db->connect();

    $stmt = $pdo->query("SELECT id, link, name, price FROM product ORDER BY id ASC");
    $products = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data' => $products
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>