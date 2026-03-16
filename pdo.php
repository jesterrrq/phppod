<?php
try {
    $host = '127.0.0.1';
    $db = 'pd';
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
    $stmt = $pdo->query('SELECT * FROM pd');
    var_dump($stmt);
    echo "<br/>";
    while ($row = $stmt->fetch())
    {
        echo $row['name']." ".$row['surname']." ".$row['ote']." ".$row['data'];
        echo "<br/>";
    }
    // Вставка данных
    $name = "";
    $surname = "";
    $ote = "";
    $data = 100;

    $stmt = $pdo->prepare("INSERT INTO pd (name, surname,ote,data) VALUES ( ?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $surname);
    $stmt->bindParam(3, $ote);
    $stmt->bindParam(4, $data);
    $stmt->execute();

    $stmt = $pdo->prepare("INSERT INTO ppd (id, name, cost, color) VALUES (?, ?, ?, ?)");
    $stmt->execute([1, 'Анна', 100000, 'белый']);

    $conn = new mysqli("id", "name","cost", "color");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $userid = $conn->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM Users WHERE id = '$userid'";
    if($conn->query($sql)){

        header("Location: pdo.php");
    }
    else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}
?>