<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$data_file = __DIR__ . '/../data/clients.json';
$clients   = json_decode(file_get_contents($data_file), true) ?? [];

if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $clients = array_values(array_filter($clients, fn($c) => $c['id'] !== $id));
  file_put_contents($data_file, json_encode($clients, JSON_PRETTY_PRINT));
  header('Location: clients.php'); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  $entry = [
    'id'          => $id ?: (max(array_column($clients, 'id') ?: [0]) + 1),
    'name'        => trim($_POST['name']),
    'project'     => trim($_POST['project']),
    'testimonial' => trim($_POST['testimonial']),
    'rating'      => (int)$_POST['rating'],
    'year'        => (int)$_POST['year'],
  ];
  if ($id) {
    foreach ($clients as &$c) { if ($c['id'] === $id) { $c = $entry; break; } }
  } else {
    $clients[] = $entry;
  }
  file_put_contents($data_file, json_encode($clients, JSON_PRETTY_PRINT));
  header('Location: clients.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Clients — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="sidebar-logo">TRADIANT<span>.</span></div>
    <nav class="sidebar-nav">
      <a href="dashboard.php">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages</a>
      <a href="services.php">🔧 Services</a>
      <a href="clients.php" class="active">👥 Clients</a>
      <a href="settings.php">⚙️ Settings</a>
      <a href="logout.php">🚪 Logout</a>
    </nav>
  </aside>
  <main class="admin-main">
    <div class="admin-header">
      <h1>Clients</h1>
      <button class="btn btn-primary" style="font-size:12px;padding:9px 18px;" onclick="openModal()">+ Add Client</button>
    </div>

    <table class="admin-table">
      <thead>
        <tr><th>Name</th><th>Project</th><th>Testimonial</th><th>Rating</th><th>Year</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($clients as $c): ?>
        <tr>
          <td style="color:var(--white);font-weight:600;"><?= htmlspecialchars($c['name']) ?></td>
          <td style="font-size:12px;"><?= htmlspecialchars($c['project']) ?></td>
          <td style="font-size:12px;max-width:200px;"><?= htmlspecialchars(mb_substr($c['testimonial'],0,60)) ?>...</td>
          <td style="color:var(--orange);"><?= str_repeat('★', $c['rating']) ?></td>
          <td><?= $c['year'] ?></td>
          <td>
            <div class="action-btns">
              <button class="act-btn act-btn-edit" onclick='openModal(<?= json_encode($c) ?>)'>Edit</button>
              <a href="clients.php?delete=<?= $c['id'] ?>" onclick="return confirm('Delete this client?')"
                 class="act-btn act-btn-del" style="text-decoration:none;">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</div>

<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)closeModal()">
  <div class="modal">
    <h3 id="modalTitle">ADD CLIENT</h3>
    <form method="POST">
      <input type="hidden" name="id" id="f_id">
      <div class="form-group"><label>Client Name</label><input type="text" name="name" id="f_name" required></div>
      <div class="form-group"><label>Project</label><input type="text" name="project" id="f_project" placeholder="3BHK Residential, Pune" required></div>
      <div class="form-group"><label>Testimonial</label><textarea name="testimonial" id="f_testimonial" style="min-height:90px;" required></textarea></div>
      <div class="form-row">
        <div class="form-group">
          <label>Rating</label>
          <select name="rating" id="f_rating">
            <option value="5">★★★★★ (5)</option>
            <option value="4">★★★★☆ (4)</option>
            <option value="3">★★★☆☆ (3)</option>
          </select>
        </div>
        <div class="form-group"><label>Year</label><input type="number" name="year" id="f_year" value="<?= date('Y') ?>" required></div>
      </div>
      <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">Save Client</button>
        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(c) {
  document.getElementById('modalOverlay').classList.add('open');
  if (c) {
    document.getElementById('modalTitle').textContent = 'EDIT CLIENT';
    document.getElementById('f_id').value          = c.id;
    document.getElementById('f_name').value        = c.name;
    document.getElementById('f_project').value     = c.project;
    document.getElementById('f_testimonial').value = c.testimonial;
    document.getElementById('f_rating').value      = c.rating;
    document.getElementById('f_year').value        = c.year;
  } else {
    document.getElementById('modalTitle').textContent = 'ADD CLIENT';
    document.getElementById('f_id').value = '';
    ['f_name','f_project','f_testimonial'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('f_rating').value = '5';
    document.getElementById('f_year').value = '<?= date('Y') ?>';
  }
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
}
</script>
</body>
</html>
