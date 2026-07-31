<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

$data_file = __DIR__ . '/../data/services.json';
$services  = json_decode(file_get_contents($data_file), true) ?? [];

// DELETE
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $services = array_values(array_filter($services, fn($s) => $s['id'] !== $id));
  file_put_contents($data_file, json_encode($services, JSON_PRETTY_PRINT));
  header('Location: services.php');
  exit;
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
  header('Location: services.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Services — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <!-- SIDEBAR -->
  <aside class="admin-sidebar">
    <div class="sidebar-logo">
      <img src="../assets/images/logo.png" alt="Tradiant" onerror="this.style.display='none'">
      <div>TRADIANT<span>.</span></div>
    </div>
    <nav class="sidebar-nav">
      <a href="dashboard.php">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages</a>
      <a href="services.php" class="active">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php">⚙️ Settings</a>
      <a href="logout.php" style="margin-top:auto; color: #f87171;">🚪 Logout</a>
    </nav>
    <div class="sidebar-user">
      <div class="user-avatar">A</div>
      <div class="user-info">
        <span class="user-name">Administrator</span>
        <span class="user-role">Super Admin</span>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="admin-main">
    <div class="admin-header">
      <div>
        <h1>🔧 Service Offerings</h1>
        <p style="font-size: 13px; color: var(--admin-text-muted); margin-top: 4px;">Manage the services displayed on your public website.</p>
      </div>
      <div class="admin-header-actions">
        <button class="btn-admin-submit" style="width:auto; padding: 10px 20px; font-size: 13px;" onclick="openModal()">
          + Add New Service
        </button>
      </div>
    </div>

    <div class="admin-card">
      <div class="admin-table-wrap">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Icon</th>
              <th>Service Title</th>
              <th>Description</th>
              <th>Key Features</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($services as $s): ?>
            <tr>
              <td style="font-size: 26px; text-align: center; width: 60px;"><?= $s['icon'] ?></td>
              <td style="font-weight: 700; color: #ffffff; width: 180px;"><?= htmlspecialchars($s['title']) ?></td>
              <td style="font-size: 12.5px; color: var(--admin-text-muted); max-width: 280px;"><?= htmlspecialchars(mb_substr($s['description'], 0, 70)) ?>...</td>
              <td style="font-size: 12px;"><span class="badge badge-blue"><?= count($s['features']) ?> features</span></td>
              <td>
                <div style="display: flex; gap: 8px;">
                  <button class="act-btn act-btn-edit" onclick='openModal(<?= json_encode($s) ?>)'>✏️ Edit</button>
                  <a href="services.php?delete=<?= $s['id'] ?>" onclick="return confirm('Delete this service?')" class="act-btn act-btn-del" style="text-decoration:none;">🗑️ Delete</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)closeModal()">
  <div class="modal">
    <h3 id="modalTitle">ADD NEW SERVICE</h3>
    <form method="POST">
      <input type="hidden" name="id" id="f_id">
      <div class="admin-form-group">
        <label>Icon (Emoji)</label>
        <input type="text" name="icon" id="f_icon" class="admin-input" placeholder="🔧" required>
      </div>
      <div class="admin-form-group">
        <label>Service Title</label>
        <input type="text" name="title" id="f_title" class="admin-input" placeholder="Electrical & Repairs" required>
      </div>
      <div class="admin-form-group">
        <label>Description</label>
        <textarea name="description" id="f_desc" class="admin-input" style="min-height: 80px; resize: vertical;" required></textarea>
      </div>
      <div class="admin-form-group">
        <label>Hero Image Path</label>
        <input type="text" name="hero_image" id="f_img" class="admin-input" placeholder="assets/images/heroes/electrician.png">
      </div>
      <div class="admin-form-group">
        <label>Features (One per line)</label>
        <textarea name="features" id="f_features" class="admin-input" style="min-height: 100px; resize: vertical;" placeholder="Wiring Installation&#10;Circuit Breakers&#10;Lighting Setup"></textarea>
      </div>
      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="button" class="act-btn" style="flex:1; justify-content:center; padding: 12px; background: rgba(255,255,255,0.08); color:#fff;" onclick="closeModal()">Cancel</button>
        <button type="submit" class="btn-admin-submit" style="flex:1; margin-top:0;">Save Service</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(s = null) {
  document.getElementById('modalTitle').innerText = s ? 'EDIT SERVICE' : 'ADD NEW SERVICE';
  document.getElementById('f_id').value       = s ? s.id : '';
  document.getElementById('f_icon').value     = s ? s.icon : '';
  document.getElementById('f_title').value    = s ? s.title : '';
  document.getElementById('f_desc').value     = s ? s.description : '';
  document.getElementById('f_img').value      = s ? (s.hero_image || '') : '';
  document.getElementById('f_features').value = s ? (s.features || []).join('\n') : '';
  document.getElementById('modalOverlay').classList.add('active');
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('active');
}
</script>
</body>
</html>
