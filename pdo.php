<?php
try {
    $host = '127.0.0.1';
    $db = 'pdo';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    // Получение объекта PDO
    $pdo = new PDO($dsn, $user, $pass, $opt);
    var_dump($pdo);
    echo "<br/>";

    // Получение данных из таблицы student по полю name
    $stmt = $pdo->query('SELECT * FROM student');
    var_dump($stmt);
    echo "<br/>";
    while ($row = $stmt->fetch())
    {
        echo $row['name']." ".$row['ote']." ".$row['stepen']." ".$row['dr_st'];
        echo "<br/>";
        //printf("%d", $row['stepen']);
    }

} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}


?>