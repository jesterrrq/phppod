<?php
// pdo.php - подключение к БД
class DB {
    private $host = 'localhost';
    private $db   = 'reg';
    private $user = 'root';      // замените на вашего пользователя
    private $pass = '';          // замените на ваш пароль
    private $charset = 'utf8mb4';
    private $pdo = null;

    public function connect() {
        if ($this->pdo !== null) return $this->pdo;

        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        return $this->pdo;
    }
}
?>