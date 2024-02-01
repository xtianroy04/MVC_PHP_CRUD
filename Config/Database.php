<?php

class Database{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mvc";

    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }
    
    public function getConnection() {
        return $this->conn;
    }

    public function getError() {
        return $this->conn->error;
    }
}
?>