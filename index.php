<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'register';

switch ($page) {
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
    case 'incoming':
        require_once 'views/incoming.php';
        break;
    case 'received':
        require_once 'views/received.php';
        break;
    case 'add_document':
        require_once 'controllers/DocumentController.php';
        add_document();
        break;
    case 'add_user':
        require_once 'controllers/UserController.php';
        register();
        break;
    case 'audit_log':
        require_once 'views/audit_log.php';
        break;
    case 'login_history':
        require_once 'views/login_history.php';
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    default:
        echo '404 - Page not found.';
        break;
}
