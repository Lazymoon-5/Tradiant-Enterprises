<?php
$page_title = 'About Us';
$page_desc = 'Learn about Tradiant Enterprises and our Master Automation Expert & Technical Consultant serving clients since 1997.';
require_once '../includes/header.php';
?>

<!-- ── PAGE HEADER ── -->
<div style="background: var(--bg-surface); border-bottom: 1px solid var(--border-rose); padding: 70px 5% 50px 5%; text-align: center;">
  <div style="max-width: 850px; margin: 0 auto;">
    <span class="section-tag">Master Consultant & Automation Expert (Since 1997)</span>
    <h1 class="section-title" style="font-size: clamp(34px, 5vw, 52px); margin-top: 6px;">
      About <span style="background: var(--gradient-rose); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tradiant Enterprises</span>
    </h1>
    <p class="section-subtitle" style="margin-top: 12px; font-size: 16px;">
      Built on 29+ years of hands-on technical experience, home & industrial automation, site supervision, and multi-trade mastery since 1997. "Any task — Solutionized."
    </p>
  </div>
</div>

<!-- ── ABOUT CONTENT GRID ── -->
<div class="section">
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto; align-items: center;">
    
    <!-- Image Box -->
    <div style="position: relative; display: flex; justify-content: center; align-items: center;">
      <div style="position: absolute; width: 320px; height: 320px; border-radius: 50%; background: radial-gradient(circle, rgba(183, 110, 121, 0.18) 0%, transparent 70%); filter: blur(25px); pointer-events: none;"></div>
      <img src="../assets/images/heroes/supervisor.png" alt="Master Consultant" style="max-height: 400px; width: auto; position: relative; z-index: 2; filter: drop-shadow(0 15px 25px rgba(42,30,34,0.15));">
    </div>

    <!-- Content Box -->
    <div>
      <span class="section-tag">Serving Clients Since 1997</span>
      <h2 class="section-title" style="font-size: 32px; margin-bottom: 16px;">One Call to Solve Every Service & Automation Need</h2>
      <p style="color: var(--text-muted); font-size: 15px; line-height: 1.7; margin-bottom: 16px;">
        Working continuously since 1997, Tradiant Enterprises specializes in <strong>Home & Industrial Automation</strong>, Smart Switches, Sensor Integration, and turnkey site supervision.
      </p>
      <p style="color: var(--text-muted); font-size: 15px; line-height: 1.7; margin-bottom: 24px;">
        Instead of coordinating with multiple untrusted local contractors, one single call brings you 29+ years of master consultation and flawless task execution with a 99% satisfaction rate.
      </p>

      <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px;">
        <div style="display: flex; align-items: center; gap: 10px; color: var(--mauve-deep); font-size: 14px; font-weight: 600;">
          <span>✓</span> Specialization in Automation, Smart Controls & Panel Wiring
        </div>
        <div style="display: flex; align-items: center; gap: 10px; color: var(--mauve-deep); font-size: 14px; font-weight: 600;">
          <span>✓</span> 29+ Years of hands-on field experience since 1997
        </div>
        <div style="display: flex; align-items: center; gap: 10px; color: var(--mauve-deep); font-size: 14px; font-weight: 600;">
          <span>✓</span> Turnkey execution from site planning to handover
        </div>
        <div style="display: flex; align-items: center; gap: 10px; color: var(--mauve-deep); font-size: 14px; font-weight: 600;">
          <span>✓</span> Transparent itemized cost estimation with zero hidden fees
        </div>
      </div>

      <div style="display: flex; gap: 14px; flex-wrap: wrap;">
        <a href="tel:+919823941939" class="nav-cta">📞 Call +91 9823941939</a>
        <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20want%20to%20consult%20regarding%20automation%20or%20site%20work." target="_blank" rel="noopener" class="nav-cta" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);">💬 WhatsApp Solutionizer</a>
      </div>
    </div>
  </div>
</div>

<!-- ── CORE VALUES ── -->
<div class="section" style="background: var(--bg-surface); border-top: 1px solid var(--border-rose);">
  <div class="section-header">
    <span class="section-tag">Guiding Principles</span>
    <h2 class="section-title">What Drives Our Work</h2>
  </div>

  <div class="cards-grid">
    <div class="feature-card">
      <div class="card-icon">🎯</div>
      <h3 class="card-title">Precision Quality</h3>
      <div class="card-body">Every automation circuit, wire connection, and structure built to strict standards.</div>
    </div>
    <div class="feature-card">
      <div class="card-icon">🤝</div>
      <h3 class="card-title">Honest Integrity</h3>
      <div class="card-body">Serving families and businesses since 1997 with 99% satisfaction and honest pricing.</div>
    </div>
    <div class="feature-card">
      <div class="card-icon">🤖</div>
      <h3 class="card-title">Automation Mastery</h3>
      <div class="card-body">Advanced smart control setups, sensor integrations, and custom panel engineering.</div>
    </div>
  </div>
</div>

<?php require_once '../includes/footer.php'; ?>
