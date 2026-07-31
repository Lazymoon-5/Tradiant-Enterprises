<?php
if (!function_exists('get_json')) {
  function get_json($file) {
    $tmp_path = sys_get_temp_dir() . '/' . $file;
    if (file_exists($tmp_path)) {
      return json_decode(file_get_contents($tmp_path), true) ?? [];
    }
    $path = __DIR__ . '/../data/' . $file;
    if (!file_exists($path)) return [];
    return json_decode(file_get_contents($path), true) ?? [];
  }
}

if (!function_exists('save_json')) {
  function save_json($file, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    $path = __DIR__ . '/../data/' . $file;
    $saved = @file_put_contents($path, $json);
    if ($saved === false) {
      $tmp_path = sys_get_temp_dir() . '/' . $file;
      @file_put_contents($tmp_path, $json);
    }
  }
}

$req_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' — ' : '' ?>Tradiant Enterprises | Master Service Marketplace & Consultant</title>
  <meta name="description" content="<?= isset($page_desc) ? htmlspecialchars($page_desc) : 'Tradiant Enterprises — Any task - Solutionize. One call solutions for supervision, electrical, plumbing, masonry, painting, landscaping, and master technical consultations.' ?>">
  <link rel="icon" href="/assets/images/logo.png" type="image/png">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="light-theme">

<nav class="navbar">
  <a href="/" class="nav-brand">
    <img src="/assets/images/logo.png" alt="Tradiant Enterprises Logo" class="nav-logo-img">
    <div class="nav-title-group">
      <span class="nav-logo-text">Tradiant Enterprises</span>
      <span class="nav-tagline">Any task - Solutionize</span>
    </div>
  </a>

  <div class="nav-links" id="navLinks">
    <a href="/" class="<?= ($req_uri == '/' || strpos($req_uri, 'index') !== false) ? 'active' : '' ?>">Home</a>
    <a href="/pages/about.php" class="<?= (strpos($req_uri, 'about') !== false) ? 'active' : '' ?>">About</a>
    <a href="/pages/services.php" class="<?= (strpos($req_uri, 'services') !== false) ? 'active' : '' ?>">Services</a>
    <a href="/pages/clients.php" class="<?= (strpos($req_uri, 'clients') !== false) ? 'active' : '' ?>">Clients</a>
    <a href="/pages/contact.php" class="<?= (strpos($req_uri, 'contact') !== false) ? 'active' : '' ?>">Contact</a>
    <a href="tel:+919823941939" class="nav-cta">📞 Call Solutionizer</a>
  </div>

  <button class="hamburger" id="hamburger" aria-label="Toggle navigation">
    <span></span>
    <span></span>
    <span></span>
  </button>
</nav>

<div class="page-wrapper" style="margin-top: var(--nav-h);">
