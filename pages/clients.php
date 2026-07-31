<?php
$page_title = 'Client Testimonials';
$page_desc = 'Read what homeowners, business owners, and site managers say about Tradiant Enterprises and our Master Solutionizer.';
require_once __DIR__ . '/../includes/header.php';
$clients = get_json('clients.json');
?>

<!-- ── PAGE HEADER ── -->
<div style="background: var(--bg-surface); border-bottom: 1px solid var(--border-rose); padding: 70px 5% 50px 5%; text-align: center;">
  <div style="max-width: 850px; margin: 0 auto;">
    <span class="section-tag">Proof of Excellence</span>
    <h1 class="section-title" style="font-size: clamp(34px, 5vw, 52px); margin-top: 6px;">
      Trusted By <span style="background: var(--gradient-rose); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Hundreds</span>
    </h1>
    <p class="section-subtitle" style="margin-top: 12px; font-size: 16px;">
      Real homeowners, business proprietors, and project developers share their experiences with Tradiant Enterprises.
    </p>
  </div>
</div>

<!-- ── TESTIMONIALS GRID ── -->
<div class="section">
  <div class="cards-grid">
    <?php foreach ($clients as $c): ?>
    <div class="feature-card">
      <div style="color: #E6A100; font-size: 18px; margin-bottom: 10px;">
        <?= str_repeat('★', (int)$c['rating']) ?>
      </div>
      <p style="font-size: 14px; color: var(--text-muted); line-height: 1.7; font-style: italic; margin-bottom: 20px;">
        "<?= htmlspecialchars($c['testimonial']) ?>"
      </p>
      <div style="margin-top: auto; padding-top: 14px; border-top: 1px solid var(--border-rose);">
        <div style="font-family: var(--font-display); font-size: 17px; font-weight: 700; color: var(--mauve-deep);">
          <?= htmlspecialchars($c['name']) ?>
        </div>
        <div style="font-size: 12px; color: var(--text-dim); margin-top: 2px;">
          <?= htmlspecialchars($c['project']) ?> &nbsp;·&nbsp; <?= htmlspecialchars($c['year']) ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ── METRICS BANNER ── -->
<div style="background: var(--bg-surface); border-top: 1px solid var(--border-rose); border-bottom: 1px solid var(--border-rose); padding: 35px 5%;">
  <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px; text-align: center;">
    <div>
      <div style="font-family: var(--font-display); font-size: 36px; font-weight: 800; color: var(--mauve-deep);">100+</div>
      <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Happy Clients</div>
    </div>
    <div>
      <div style="font-family: var(--font-display); font-size: 36px; font-weight: 800; color: var(--mauve-deep);">5.0 ★</div>
      <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Average Rating</div>
    </div>
    <div>
      <div style="font-family: var(--font-display); font-size: 36px; font-weight: 800; color: var(--mauve-deep);">100%</div>
      <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">On-Time Delivery</div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
