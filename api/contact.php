<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'error' => 'Method not allowed']);
  exit;
}

$name    = trim($_POST['name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$email   = trim($_POST['email'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$phone) {
  echo json_encode(['success' => false, 'error' => 'Name and phone are required']);
  exit;
}

$messages = get_json('messages.json');

$messages[] = [
  'id'      => time(),
  'name'    => $name,
  'phone'   => $phone,
  'email'   => $email,
  'service' => $service,
  'message' => $message,
  'date'    => date('Y-m-d H:i:s'),
  'read'    => false,
];

save_json('messages.json', $messages);
echo json_encode(['success' => true]);
