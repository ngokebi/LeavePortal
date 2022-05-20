<?php

require_once "config.php";

class Database
{

    private ?PDO $conn = null;
    private string $host = DB_HOST;
    private string $name = DB_NAME;
    private string $user = DB_USER;
    private string $password = DB_PASS;

    public function getConnection(): PDO
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->name, $this->user, $this->password, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_STRINGIFY_FETCHES => false
                ));
            } catch (PDOException $e) {
                echo "Please check your Database Connection and Try Again! </br>";
                exit("Error: " . $e->getMessage());
            }


            return $this->conn;
        }
    }
}
