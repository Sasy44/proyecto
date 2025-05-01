<?php
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../models/Categoria.php';

class TaskController {
    private $taskModel;
    private $categoryModel;

    public function __construct() {
        $this->taskModel = new Task();
        $this->categoryModel = new Category();
    }

    public function index() {
        $tasks = $this->taskModel->getAll();
        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../views/indice.php';
    }

    public function today() {
        $tasks = $this->taskModel->getToday();
        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../views/hoy.php';
    }

    public function completed() {
        $tasks = $this->taskModel->getCompleted();
        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../views/completado.php';
    }

    public function pending() {
        $tasks = $this->taskModel->getPending();
        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../views/pendiente.php';
    }

    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $due_date = filter_input(INPUT_POST, 'due_date', FILTER_SANITIZE_STRING);
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

            if (empty($title)) {
                $errors[] = "Title is required.";
            }
            if (empty($due_date) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $due_date)) {
                $errors[] = "Valid due date is required (YYYY-MM-DD).";
            }

            if (empty($errors)) {
                if ($this->taskModel->create($title, $description, $due_date, $category_id)) {
                    header('Location: index.php?action=index');
                    exit;
                } else {
                    $errors[] = "Failed to create task.";
                }
            }
        }
        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../views/indice.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $completed = filter_input(INPUT_POST, 'completed', FILTER_VALIDATE_BOOLEAN);
            if ($id) {
                $this->taskModel->updateStatus($id, $completed);
            }
        }
        header('Location: index.php?action=index');
        exit;
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if ($id) {
                $this->taskModel->delete($id);
            }
        }
        header('Location: index.php?action=index');
        exit;
    }
}
?>