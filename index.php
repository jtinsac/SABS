<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'register';

switch ($page) {
    case 'register':
        require_once 'controllers/UserController.php';
        register();
        break;
    case 'login':
        require_once 'controllers/UserController.php';
        login();
        break;
    case 'dashboard':
        require_once 'views/dashboard.php';
        break;
    case 'documents':
        require_once 'views/documents.php';
        break;
    case 'outgoing':
        require_once 'views/outgoing.php';
        break;
    case 'add_document':
        require_once 'controllers/DocumentController.php';
        add_document();
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    default:
        echo '404 - Page not found.';
        break;
}
