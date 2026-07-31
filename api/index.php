<?php
// Set working directory to project root
chdir(__DIR__ . '/..');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static assets directly if hit via router
$file = __DIR__ . '/..' . $uri;
if (file_exists($file) && !is_dir($file)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mimeTypes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'json'  => 'application/json',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf'
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        header('Cache-Control: public, max-age=31536000, immutable');
        readfile($file);
        exit;
    }
}

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
        if (file_exists($file) && !is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            require $file;
        } else {
            require __DIR__ . '/../index.php';
        }
        break;
}
