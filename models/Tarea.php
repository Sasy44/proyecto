<?php
require_once __DIR__ . '/../config/database.php';

class Task {
    private $conn;
    private $table = 'tareas';

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT t.*, c.name as category_name FROM $this->table t LEFT JOIN categorias c ON t.category_id = c.id";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getToday() {
        $query = "SELECT t.*, c.name as category_name FROM $this->table t LEFT JOIN categorias c ON t.category_id = c.id WHERE t.due_date = CURDATE() AND t.completed = FALSE";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getCompleted() {
        $query = "SELECT t.*, c.name as category_name FROM $this->table t LEFT JOIN categorias c ON t.category_id = c.id WHERE t.completed = TRUE";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getPending() {
        $query = "SELECT t.*, c.name as category_name FROM $this->table t LEFT JOIN categorias c ON t.category_id = c.id WHERE t.completed = FALSE";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function create($title, $description, $due_date, $category_id) {
        $query = "INSERT INTO $this->table (title, description, due_date, category_id) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->conn));
        }
        $category_id = $category_id ?: null;
        mysqli_stmt_bind_param($stmt, 'sssi', $title, $description, $due_date, $category_id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }

    public function updateStatus($id, $completed) {
        $query = "UPDATE $this->table SET completed = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->conn));
        }
        $completed = $completed ? 1 : 0; // Booleano a entero
        mysqli_stmt_bind_param($stmt, 'ii', $completed, $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($this->conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
}
?>