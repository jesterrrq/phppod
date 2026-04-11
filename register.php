<?php
// Заголовки CORS (должны быть ДО любого вывода)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Заголовок ответа
header('Content-Type: application/json; charset=utf-8');

// Проверка метода
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Подключение к БД
try {
    $host = '127.0.0.1';
    $db   = 'reg';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $opt);

    // Получение данных
    $nickname = trim($_POST['nickname'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($nickname === '' || $password === '') {
        throw new Exception('Пустые поля nickname или password');
    }

    $stmt = $pdo->prepare("INSERT INTO rebasa (nickname, password) VALUES (?, ?)");
    $stmt->execute([$nickname, $password]);

    echo json_encode([
        'success' => true,
        'message' => 'Записано в БД',
        'last_id' => $pdo->lastInsertId()
    ]);


    // чтобы проблем с бд было меньше, если будут бедет возврашать код с ошибкой
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB_ERROR: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => 'APP_ERROR: ' . $e->getMessage()]);
}
?>