<?php
if (!function_exists('get_json')) {
  function get_json($file) {
    $path = __DIR__ . '/../data/' . $file;
    if (!file_exists($path)) return [];
    return json_decode(file_get_contents($path), true) ?? [];
  }
}

if (!function_exists('save_json')) {
  function save_json($file, $data) {
    $path = __DIR__ . '/../data/' . $file;
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
  }
}

// 100% Airtight URL Route Resolver
$script_path = str_replace('\\', '/', $_SERVER['PHP_SELF']);
$in_pages_dir = (strpos($script_path, '/pages/') !== false);

if ($in_pages_dir) {
  $root_path = '../';
  $pages_prefix = '';
} else {
  $root_path = '';
  $pages_prefix = 'pages/';
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' — ' : '' ?>Tradiant Enterprises | Master Service Marketplace & Consultant</title>
  <meta name="description" content="<?= isset($page_desc) ? htmlspecialchars($page_desc) : 'Tradiant Enterprises — Any task - Solutionize. One call solutions for supervision, electrical, plumbing, masonry, painting, landscaping, and master technical consultations.' ?>">
  <link rel="icon" href="<?= $root_path ?>assets/images/logo.png" type="image/png">
  <link rel="stylesheet" href="<?= $root_path ?>assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="light-theme">

<nav class="navbar">
  <a href="<?= $root_path ?>index.php" class="nav-brand">
    <img src="<?= $root_path ?>assets/images/logo.png" alt="Tradiant Enterprises Logo" class="nav-logo-img">
    <div class="nav-title-group">
      <span class="nav-logo-text">Tradiant Enterprises</span>
      <span class="nav-tagline">Any task - Solutionize</span>
    </div>
  </a>

  <div class="nav-links">
    <a href="<?= $root_path ?>index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
    <a href="<?= $pages_prefix ?>about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About</a>
    <a href="<?= $pages_prefix ?>services.php" class="<?= ($current_page == 'services.php') ? 'active' : '' ?>">Services</a>
    <a href="<?= $pages_prefix ?>clients.php" class="<?= ($current_page == 'clients.php') ? 'active' : '' ?>">Clients</a>
    <a href="<?= $pages_prefix ?>contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a>
    <a href="tel:+919823941939" class="nav-cta">📞 Call Solutionizer</a>
  </div>

  <button class="hamburger" aria-label="Toggle Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<div class="page-wrapper">
