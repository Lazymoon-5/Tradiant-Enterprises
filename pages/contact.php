<?php
$page_title = 'Contact Master Solutionizer';
$page_desc = 'Contact Tradiant Enterprises — Call +91 9823941939 or send an inquiry for instant site consultation and service booking.';
require_once __DIR__ . '/../includes/header.php';
$services = get_json('services.json');
?>

<!-- ── PAGE HEADER ── -->
<div style="background: var(--bg-surface); border-bottom: 1px solid var(--border-rose); padding: 70px 5% 50px 5%; text-align: center;">
  <div style="max-width: 850px; margin: 0 auto;">
    <span class="section-tag">Direct Master Contact</span>
    <h1 class="section-title" style="font-size: clamp(34px, 5vw, 52px); margin-top: 6px;">
      Just a Call <span style="background: var(--gradient-rose); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Away</span>
    </h1>
    <p class="section-subtitle" style="margin-top: 12px; font-size: 16px;">
      Have a task or project to solutionize? Call, WhatsApp, or send an inquiry below for immediate site inspection and estimates.
    </p>
  </div>
</div>

<div class="section">
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 36px; max-width: 1200px; margin: 0 auto;">
    
    <!-- CONTACT CARDS / DIRECT ACTION -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
      
      <!-- Phone Box -->
      <div class="feature-card" style="padding: 22px;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div class="card-icon" style="margin-bottom: 0;">📞</div>
          <div>
            <h4 style="font-family: var(--font-display); font-size: 17px; color: var(--mauve-deep);">Phone Call</h4>
            <a href="tel:+919823941939" style="font-size: 20px; font-weight: 800; color: var(--text-main);">+91 9823941939</a>
            <div style="font-size: 12px; color: var(--text-dim); margin-top: 2px;">Direct Line to Master Solutionizer</div>
          </div>
        </div>
      </div>

      <!-- WhatsApp Box -->
      <div class="feature-card" style="padding: 22px; border-color: rgba(37, 211, 102, 0.4);">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div class="card-icon" style="margin-bottom: 0; background: rgba(37, 211, 102, 0.12); color: #128C7E; border-color: rgba(37, 211, 102, 0.3);">💬</div>
          <div>
            <h4 style="font-family: var(--font-display); font-size: 17px; color: #128C7E;">WhatsApp Solutionizer</h4>
            <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20want%20to%20consult%20about%20a%20service." target="_blank" rel="noopener" style="font-size: 18px; font-weight: 700; color: #128C7E;">+91 9823941939</a>
            <div style="font-size: 12px; color: var(--text-dim); margin-top: 2px;">Instant Chat & Photos Sharing</div>
          </div>
        </div>
      </div>

      <!-- Location Box -->
      <div class="feature-card" style="padding: 22px;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div class="card-icon" style="margin-bottom: 0;">📍</div>
          <div>
            <h4 style="font-family: var(--font-display); font-size: 17px; color: var(--mauve-deep);">Service Coverage</h4>
            <p style="font-size: 13.5px; color: var(--text-muted);">Available for turn-key projects, site supervision, and local task dispatches.</p>
          </div>
        </div>
      </div>

      <!-- Free Site Visit Banner -->
      <div style="padding: 22px; background: rgba(183, 110, 121, 0.08); border: 1px solid var(--border-rose); border-radius: var(--radius-lg);">
        <h4 style="font-family: var(--font-display); font-size: 17px; color: var(--mauve-deep); margin-bottom: 6px;">✨ Free Site Audit & Estimation</h4>
        <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
          We offer complimentary initial site visits and itemized estimations with no obligations attached.
        </p>
      </div>

    </div>

    <!-- INQUIRY FORM -->
    <div class="feature-card" style="padding: 32px;">
      <h3 style="font-family: var(--font-display); font-size: 24px; font-weight: 700; color: var(--text-main); margin-bottom: 6px;">Send a Service Inquiry</h3>
      <p style="font-size: 13px; color: var(--text-dim); margin-bottom: 22px;">Fill in your requirements and we will contact you immediately.</p>

      <div id="formSuccess" style="display: none; padding: 14px; background: rgba(37, 211, 102, 0.12); border: 1px solid #25D366; border-radius: var(--radius-sm); color: #128C7E; font-weight: 700; margin-bottom: 18px;">
        ✅ Thank you! Your inquiry has been received. We will call you shortly.
      </div>

      <form id="contactForm">
        <div class="form-group">
          <label>Your Name *</label>
          <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
          <label>Phone Number *</label>
          <input type="tel" name="phone" class="form-control" placeholder="+91 9823941939" required>
        </div>

        <div class="form-group">
          <label>Service Required</label>
          <select name="service" class="form-control">
            <option value="">Select a service category...</option>
            <?php foreach ($services as $s): ?>
              <option value="<?= htmlspecialchars($s['title']) ?>"><?= htmlspecialchars($s['title']) ?></option>
            <?php endforeach; ?>
            <option value="Master Consultation">Master Technical Consultation</option>
            <option value="Turnkey Construction">Turnkey Home & Site Project</option>
          </select>
        </div>

        <div class="form-group">
          <label>Task / Project Details</label>
          <textarea name="message" class="form-control" placeholder="Describe what you need solutionized (location, problem, scope...)" rows="4"></textarea>
        </div>

        <button type="submit" class="btn-submit">Solutionize My Task &rarr;</button>
      </form>
    </div>

  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
