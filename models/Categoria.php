<?php
require_once __DIR__ . '/../config/database.php';

class Category {
    private $conn;
    private $table = 'categorias';

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    }
}
?>