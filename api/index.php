<?php
// Set working directory to project root
chdir(__DIR__ . '/..');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');
if (empty($uri)) {
    $uri = '/';
}

switch ($uri) {
    case '/':
    case '/index.php':
        require __DIR__ . '/../index.php';
        break;

    case '/admin':
    case '/admin/login':
    case '/admin/login.php':
        require __DIR__ . '/../admin/login.php';
        break;

    case '/admin/dashboard':
    case '/admin/dashboard.php':
        require __DIR__ . '/../admin/dashboard.php';
        break;

    case '/admin/services':
    case '/admin/services.php':
        require __DIR__ . '/../admin/services.php';
        break;

    case '/admin/clients':
    case '/admin/clients.php':
        require __DIR__ . '/../admin/clients.php';
        break;

    case '/admin/messages':
    case '/admin/messages.php':
        require __DIR__ . '/../admin/messages.php';
        break;

    case '/admin/settings':
    case '/admin/settings.php':
        require __DIR__ . '/../admin/settings.php';
        break;

    case '/admin/logout':
    case '/admin/logout.php':
        require __DIR__ . '/../admin/logout.php';
        break;

    case '/about':
    case '/pages/about':
    case '/pages/about.php':
        require __DIR__ . '/../pages/about.php';
        break;

    case '/services':
    case '/pages/services':
    case '/pages/services.php':
        require __DIR__ . '/../pages/services.php';
        break;

    case '/clients':
    case '/pages/clients':
    case '/pages/clients.php':
        require __DIR__ . '/../pages/clients.php';
        break;

    case '/contact':
    case '/pages/contact':
    case '/pages/contact.php':
        require __DIR__ . '/../pages/contact.php';
        break;

    case '/api/contact':
    case '/api/contact.php':
        require __DIR__ . '/../api/contact.php';
        break;

    default:
        $file = __DIR__ . '/..' . $uri;
        if (file_exists($file) && !is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            require $file;
        } else {
            require __DIR__ . '/../index.php';
        }
        break;
}
