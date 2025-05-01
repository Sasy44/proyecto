<?php
require_once __DIR__ . '/controllers/C_Tareas.php';

$controller = new TaskController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'today':
        $controller->today();
        break;
    case 'completed':
        $controller->completed();
        break;
    case 'pending':
        $controller->pending();
        break;
    case 'create':
        $controller->create();
        break;
    case 'updateStatus':
        $controller->updateStatus();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
}
?>