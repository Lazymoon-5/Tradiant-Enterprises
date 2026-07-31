<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

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

$data_file = __DIR__ . '/../data/messages.json';
$messages  = json_decode(file_get_contents($data_file), true) ?? [];

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

file_put_contents($data_file, json_encode($messages, JSON_PRETTY_PRINT));
echo json_encode(['success' => true]);
