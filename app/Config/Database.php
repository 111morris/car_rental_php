<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $conn;

    private $host;
    private $db_name;
    private $username;
    private $password;
    private $port;

    private function __construct()
    {
        $configFile = __DIR__ . '/config.php';
        $config = [];
        
        if (file_exists($configFile)) {
            $config = require $configFile;
        }
        
        $this->host = $config['db_host'] ?? getenv('DB_HOST') ?: 'localhost';
        $this->db_name = $config['db_name'] ?? getenv('DB_NAME') ?: 'carjack';
        $this->username = $config['db_user'] ?? getenv('DB_USER') ?: 'root';
        $this->password = $config['db_pass'] ?? getenv('DB_PASS') ?: '';
        $this->port = $config['db_port'] ?? getenv('DB_PORT') ?: '3306';

        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
