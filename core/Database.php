<?php
class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $host = 'localhost';
        $db = 'boost_vaccine';
        $user = 'root';
        $pass = 'rahasia';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
    public static function all_users()
    {
        $db = Database::getInstance();
        $query = $db->query("SELECT id, Name, Email, PhoneNumber, IsAdmin FROM users");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
