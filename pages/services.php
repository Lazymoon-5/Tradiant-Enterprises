<?php
$page_title = 'Our Services';
$page_desc = 'Explore all construction, site supervision, electrical, plumbing, masonry, painting, and landscaping services solutionized by Tradiant Enterprises.';
require_once '../includes/header.php';
$services = get_json('services.json');
?>

<!-- ── PAGE HEADER ── -->
<div style="background: var(--bg-surface); border-bottom: 1px solid var(--border-rose); padding: 70px 5% 50px 5%; text-align: center;">
  <div style="max-width: 850px; margin: 0 auto;">
    <span class="section-tag">Marketplace & Solutionizer Portfolio</span>
    <h1 class="section-title" style="font-size: clamp(34px, 5vw, 52px); margin-top: 6px;">
      Works We <span style="background: var(--gradient-rose); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Solutionize</span>
    </h1>
    <p class="section-subtitle" style="margin-top: 12px; font-size: 16px;">
      Every trade. Every requirement. One master consultant you can trust from start to finish.
    </p>
  </div>
</div>

<!-- ── SERVICES GRID ── -->
<div class="section">
  <div class="cards-grid">
    <?php foreach ($services as $s): ?>
    <div class="feature-card">
      <div class="card-icon"><?= $s['icon'] ?></div>
      <h3 class="card-title"><?= htmlspecialchars($s['title']) ?></h3>
      <div class="card-body">
        <p><?= htmlspecialchars($s['description']) ?></p>
        <?php if (!empty($s['features'])): ?>
          <ul style="margin-top: 12px; display: flex; flex-direction: column; gap: 6px;">
            <?php foreach ($s['features'] as $f): ?>
              <li style="font-size: 13px; color: var(--mauve-deep); display: flex; align-items: center; gap: 8px;">
                <span>•</span> <?= htmlspecialchars($f) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <div class="card-footer-action">
        <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20would%20like%20to%20inquire%20about%20<?= urlencode($s['title']) ?>%20services." 
           target="_blank" 
           rel="noopener" 
           class="btn-wa-sm">
          Book <?= htmlspecialchars($s['title']) ?> via WhatsApp &rarr;
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ── CTA BANNER ── -->
<div class="section" style="text-align: center; background: linear-gradient(135deg, rgba(183, 110, 121, 0.12) 0%, rgba(141, 70, 83, 0.06) 100%); border-top: 1px solid var(--border-rose-glow);">
  <span class="section-tag">Instant Consultation</span>
  <h2 class="section-title" style="margin-bottom: 12px;">Need a Custom Service or Site Inspection?</h2>
  <p class="section-subtitle" style="margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
    Just a call and your problem is solved. Discuss your budget, scope, and timeline directly with our Master Solutionizer.
  </p>
  <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
    <a href="tel:+919823941939" class="nav-cta" style="font-size: 15px !important; padding: 14px 30px;">📞 Call +91 9823941939</a>
    <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20need%20a%20site%20inspection%20and%20quote." target="_blank" rel="noopener" class="nav-cta" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); font-size: 15px !important; padding: 14px 30px;">💬 Chat on WhatsApp</a>
  </div>
</div>

<?php require_once '../includes/footer.php'; ?>
