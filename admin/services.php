<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$data_file = __DIR__ . '/../data/services.json';
$services  = json_decode(file_get_contents($data_file), true) ?? [];

// DELETE
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $services = array_values(array_filter($services, fn($s) => $s['id'] !== $id));
  file_put_contents($data_file, json_encode($services, JSON_PRETTY_PRINT));
  header('Location: services.php'); exit;
}

// ADD or EDIT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id       = (int)($_POST['id'] ?? 0);
  $features = array_filter(array_map('trim', explode("\n", $_POST['features'] ?? '')));
  $entry = [
    'id'          => $id ?: (max(array_column($services, 'id') ?: [0]) + 1),
    'title'       => trim($_POST['title']),
    'icon'        => trim($_POST['icon']),
    'description' => trim($_POST['description']),
    'hero_image'  => trim($_POST['hero_image']),
    'features'    => array_values($features),
  ];

  if ($id) {
    foreach ($services as &$s) { if ($s['id'] === $id) { $s = $entry; break; } }
  } else {
    $services[] = $entry;
  }
  file_put_contents($data_file, json_encode($services, JSON_PRETTY_PRINT));
  header('Location: services.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Services — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="sidebar-logo">TRADIANT<span>.</span></div>
    <nav class="sidebar-nav">
      <a href="dashboard.php">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages</a>
      <a href="services.php" class="active">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php">⚙️ Settings</a>
      <a href="logout.php">🚪 Logout</a>
    </nav>
  </aside>
  <main class="admin-main">
    <div class="admin-header">
      <h1>Services</h1>
      <button class="btn btn-primary" style="font-size:12px;padding:9px 18px;" onclick="openModal()">+ Add Service</button>
    </div>

    <table class="admin-table">
      <thead>
        <tr><th>Icon</th><th>Title</th><th>Description</th><th>Features</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($services as $s): ?>
        <tr>
          <td style="font-size:24px;"><?= $s['icon'] ?></td>
          <td style="color:var(--white);font-weight:700;text-transform:uppercase;letter-spacing:1px;"><?= htmlspecialchars($s['title']) ?></td>
          <td style="font-size:12px;max-width:200px;"><?= htmlspecialchars(mb_substr($s['description'],0,60)) ?>...</td>
          <td style="font-size:11px;"><?= count($s['features']) ?> items</td>
          <td>
            <div class="action-btns">
              <button class="act-btn act-btn-edit" onclick='openModal(<?= json_encode($s) ?>)'>Edit</button>
              <a href="services.php?delete=<?= $s['id'] ?>" onclick="return confirm('Delete this service?')"
                 class="act-btn act-btn-del" style="text-decoration:none;">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)closeModal()">
  <div class="modal">
    <h3 id="modalTitle">ADD SERVICE</h3>
    <form method="POST">
      <input type="hidden" name="id" id="f_id">
      <div class="form-group"><label>Icon (emoji)</label><input type="text" name="icon" id="f_icon" placeholder="🔧" required></div>
      <div class="form-group"><label>Title</label><input type="text" name="title" id="f_title" placeholder="Plumbing" required></div>
      <div class="form-group"><label>Description</label><textarea name="description" id="f_desc" style="min-height:80px;" required></textarea></div>
      <div class="form-group"><label>Hero Image Path</label><input type="text" name="hero_image" id="f_img" placeholder="assets/images/heroes/plumber.png"></div>
      <div class="form-group"><label>Features (one per line)</label><textarea name="features" id="f_features" style="min-height:100px;" placeholder="Pipe Installation&#10;Drainage Systems&#10;Leak Repairs"></textarea></div>
      <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">Save Service</button>
        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(s) {
  document.getElementById('modalOverlay').classList.add('open');
  if (s) {
    document.getElementById('modalTitle').textContent = 'EDIT SERVICE';
    document.getElementById('f_id').value      = s.id;
    document.getElementById('f_icon').value    = s.icon;
    document.getElementById('f_title').value   = s.title;
    document.getElementById('f_desc').value    = s.description;
    document.getElementById('f_img').value     = s.hero_image;
    document.getElementById('f_features').value = s.features.join('\n');
  } else {
    document.getElementById('modalTitle').textContent = 'ADD SERVICE';
    document.getElementById('f_id').value = '';
    ['f_icon','f_title','f_desc','f_img','f_features'].forEach(id => document.getElementById(id).value = '');
  }
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
}
</script>
</body>
</html>
