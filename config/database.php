<?php
class Connection {
    protected $connection = null;
    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $db = "todo_list";
    private $port = 3306;

    protected function connect() {
        try {
            $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db, $this->port);
            if (!$this->connection) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            die("Connection failed");
        }
        return $this->connection;
    }

    public function getConnection() {
        if ($this->connection === null) {
            $this->connect();
        }
        return $this->connection;
    }
}
?>