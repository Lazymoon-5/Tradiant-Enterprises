<?php
$page_title = 'Home';
$page_desc  = 'Tradiant Enterprises — Any task - Solutionize. Master consultant & automation expert working since 1997 for home & industrial automation, site supervision, electrical, plumbing, masonry, painting, and landscaping.';
require_once __DIR__ . '/includes/header.php';

$services = get_json('services.json');

$left_svcs  = array_slice($services, 0, 3);
$right_svcs = array_slice($services, 3, 3);

$hero_images = [
  1 => 'automation',  // Automation
  2 => 'supervisor',  // Supervision
  3 => 'electrician', // Electrical
  4 => 'plumber',     // Plumbing
  5 => 'mason',       // Masonry
  6 => 'painter',     // Painting
  7 => 'supervisor',  // Landscaping
];

$sub_map = [
  'Automation'  => 'Smart · Automated · IoT Setup',
  'Supervision' => 'Quality · Safety · Audit',
  'Electrical'  => 'Certified · Safe · Reliable',
  'Plumbing'    => 'Clean · Efficient · Durable',
  'Masonry'     => 'Solid · Precise · Structural',
  'Painting'    => 'Smooth · Waterproof · Finish',
  'Landscaping' => 'Fresh · Green · Designer',
];
?>

<!-- ── HERO STAGE ── -->
<div class="hero-wrap">
  <div class="hero-top-badge">
    <svg viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
    <span>Master Automation Expert & Technical Consultant Since 1997</span>
  </div>

  <div class="hero-headline">
    <h1>
      Any Task — <span class="highlight">Solutionized</span>
    </h1>
    <span class="sub-tag">Just a call and your problem is solved. 29+ Years of Automation & Technical Expertise.</span>
  </div>

  <div class="hero-stage">
    <!-- LEFT SERVICE CARDS -->
    <div class="svc-col left">
      <?php foreach ($left_svcs as $s):
        $img = $hero_images[$s['id']] ?? 'automation';
        $sub = $sub_map[$s['title']] ?? 'Excellence · Quality';
      ?>
      <div class="svc-item" 
           data-role="<?= htmlspecialchars($s['title']) ?>"
           data-sub="<?= htmlspecialchars($sub) ?>"
           data-img="<?= $img ?>">
        <div class="svc-hex">
          <span><?= $s['icon'] ?></span>
        </div>
        <div class="svc-info">
          <div class="svc-title"><?= htmlspecialchars($s['title']) ?></div>
          <div class="svc-desc"><?= htmlspecialchars(explode(',', $s['description'])[0]) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CENTER HERO FIGURE & ARCH RING -->
    <div class="hero-figure">
      <!-- Metallic Arch Ring (Logo Motif) -->
      <div class="figure-arch-ring"></div>
      <div class="figure-glow"></div>

      <div class="figure-img-wrap">
        <img src="assets/images/heroes/automation.png?v=3d" id="img-automation" class="visible" alt="Automation & Controls" onerror="this.style.display='none'">
        <img src="assets/images/heroes/supervisor.png?v=3d" id="img-supervisor" class="hidden" alt="Master Consultant & Site Supervisor" onerror="this.style.display='none'">
        <img src="assets/images/heroes/electrician.png?v=3d" id="img-electrician" class="hidden" alt="Certified Automation & Electrical Expert" onerror="this.style.display='none'">
        <img src="assets/images/heroes/plumber.png?v=3d" id="img-plumber" class="hidden" alt="Expert Plumber" onerror="this.style.display='none'">
        <img src="assets/images/heroes/mason.png?v=3d" id="img-mason" class="hidden" alt="Master Mason" onerror="this.style.display='none'">
        <img src="assets/images/heroes/painter.png?v=3d" id="img-painter" class="hidden" alt="Painting & Finishing" onerror="this.style.display='none'">
        <img src="assets/images/heroes/automation.png?v=3d" id="img-default" class="hidden" alt="Master Technical Consultant" onerror="this.style.display='none'">
      </div>

      <div class="hero-role-card">
        <div class="hero-role-title" id="heroRoleTitle">Automation & Controls</div>
        <div class="hero-role-sub" id="heroRoleSub">Smart · Automated · IoT Setup</div>
      </div>
    </div>

    <!-- RIGHT SERVICE CARDS -->
    <div class="svc-col right">
      <?php foreach ($right_svcs as $s):
        $img = $hero_images[$s['id']] ?? 'supervisor';
        $sub = $sub_map[$s['title']] ?? 'Excellence · Quality';
      ?>
      <div class="svc-item" 
           data-role="<?= htmlspecialchars($s['title']) ?>"
           data-sub="<?= htmlspecialchars($sub) ?>"
           data-img="<?= $img ?>">
        <div class="svc-hex">
          <span><?= $s['icon'] ?></span>
        </div>
        <div class="svc-info">
          <div class="svc-title"><?= htmlspecialchars($s['title']) ?></div>
          <div class="svc-desc"><?= htmlspecialchars(explode(',', $s['description'])[0]) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- ── KEY HIGHLIGHT METRICS (3 STATS) ── -->
<div style="background: var(--bg-surface); border-top: 1px solid var(--border-rose); border-bottom: 1px solid var(--border-rose); padding: 35px 5%;">
  <div style="max-width: 1000px; margin: 0 auto; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 30px; text-align: center;">
    <div>
      <div style="font-family: var(--font-display); font-size: 38px; font-weight: 800; color: var(--mauve-deep);">29+ Years</div>
      <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Mastery Since 1997</div>
    </div>
    <div>
      <div style="font-family: var(--font-display); font-size: 38px; font-weight: 800; color: var(--mauve-deep);">350+</div>
      <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Tasks Solutionized</div>
    </div>
    <div>
      <div style="font-family: var(--font-display); font-size: 38px; font-weight: 800; color: var(--mauve-deep);">99%</div>
      <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Satisfaction Rate</div>
    </div>
  </div>
</div>

<!-- ── WHY CHOOSE TRADIANT ENTERPRISES ── -->
<div class="section">
  <div class="section-header">
    <span class="section-tag">Marketplace Excellence</span>
    <h2 class="section-title">One Call. Every Problem Solved.</h2>
    <p class="section-subtitle">Working since 1997. We specialize in Automation, Smart Controls, and complete site supervision & task execution.</p>
  </div>

  <div class="cards-grid">
    <div class="feature-card">
      <div class="card-icon">🤖</div>
      <h3 class="card-title">Automation & Smart Control</h3>
      <div class="card-body">Home smart switches, sensor integration, gate automation, and industrial control panel wiring designed with 29+ years of mastery.</div>
      <div class="card-footer-action">
        <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20am%20interested%20in%20Automation%20solutions." target="_blank" rel="noopener" class="btn-wa-sm">Automation Inquiry &rarr;</a>
      </div>
    </div>

    <div class="feature-card">
      <div class="card-icon">🧠</div>
      <h3 class="card-title">Master Consultation</h3>
      <div class="card-body">Get expert guidance on site planning, estimation, material selection, and structural safety from a consultant serving clients since 1997.</div>
      <div class="card-footer-action">
        <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20need%20master%20consultation." target="_blank" rel="noopener" class="btn-wa-sm">Consult via WhatsApp &rarr;</a>
      </div>
    </div>

    <div class="feature-card">
      <div class="card-icon">⏱️</div>
      <h3 class="card-title">Rapid Response</h3>
      <div class="card-body">Immediate technician dispatch for emergency repair work, electrical faults, or scheduled site visits. Always reliable.</div>
      <div class="card-footer-action">
        <a href="tel:+919823941939" class="btn-wa-sm">Call +91 9823941939 &rarr;</a>
      </div>
    </div>
  </div>
</div>

<!-- ── SERVICES GRID PREVIEW ── -->
<div class="section" style="background: var(--bg-surface); border-top: 1px solid var(--border-rose);">
  <div class="section-header">
    <span class="section-tag">Our Expertise</span>
    <h2 class="section-title">Services We Solutionize</h2>
    <p class="section-subtitle">Select any service to inquire or book instant site inspection.</p>
  </div>

  <div class="cards-grid">
    <?php foreach ($services as $s): ?>
    <div class="feature-card">
      <div class="card-icon"><?= $s['icon'] ?></div>
      <h3 class="card-title"><?= htmlspecialchars($s['title']) ?></h3>
      <div class="card-body"><?= htmlspecialchars($s['description']) ?></div>
      <div class="card-footer-action">
        <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20am%20interested%20in%20<?= urlencode($s['title']) ?>%20services." target="_blank" rel="noopener" class="btn-wa-sm">
          Inquire <?= htmlspecialchars($s['title']) ?> &rarr;
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ── CTA SOLUTIONIZER BANNER ── -->
<div class="section" style="text-align: center; background: linear-gradient(135deg, rgba(183, 110, 121, 0.12) 0%, rgba(141, 70, 83, 0.06) 100%); border-top: 1px solid var(--border-rose-glow);">
  <span class="section-tag">Direct Master Contact</span>
  <h2 class="section-title" style="margin-bottom: 12px;">Have a Problem on Site?</h2>
  <p class="section-subtitle" style="margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
    Don't hesitate. Call our Master Automation & Technical Consultant right away for immediate advice, estimation, and task solutionizing.
  </p>
  <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
    <a href="tel:+919823941939" class="nav-cta" style="font-size: 15px !important; padding: 14px 30px;">📞 Call +91 9823941939</a>
    <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20have%20an%20automation%20or%20site%20task%20to%20solutionize." target="_blank" rel="noopener" class="nav-cta" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); font-size: 15px !important; padding: 14px 30px;">💬 WhatsApp Solutionizer</a>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
