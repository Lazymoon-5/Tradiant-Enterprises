<?php 
$script_path = str_replace('\\', '/', $_SERVER['PHP_SELF']);
$in_pages_dir = (strpos($script_path, '/pages/') !== false);

if ($in_pages_dir) {
  $root_path = '../';
  $pages_prefix = '';
} else {
  $root_path = '';
  $pages_prefix = 'pages/';
}
?>
</div><!-- /.page-wrapper -->

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div class="nav-brand" style="margin-bottom: 12px;">
        <img src="<?= $root_path ?>assets/images/logo.png" alt="Tradiant Enterprises Logo" class="nav-logo-img" style="height: 44px;">
        <div class="nav-title-group">
          <span class="nav-logo-text">Tradiant Enterprises</span>
          <span class="nav-tagline">Any task - Solutionize</span>
        </div>
      </div>
      <p>Your one-stop local service marketplace expert & master consultant. Just a call and your problem is solved. Quality craftsmanship & site supervision.</p>
    </div>

    <div>
      <h4 class="footer-title">Services</h4>
      <ul class="footer-links">
        <li><a href="<?= $pages_prefix ?>services.php">Automation Solutions</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Site Supervision</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Electrical Solutions</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Plumbing Services</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Masonry & Structure</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Painting & Finishing</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Landscaping</a></li>
      </ul>
    </div>

    <div>
      <h4 class="footer-title">Quick Links</h4>
      <ul class="footer-links">
        <li><a href="<?= $root_path ?>index.php">Home</a></li>
        <li><a href="<?= $pages_prefix ?>about.php">About Master Consultant</a></li>
        <li><a href="<?= $pages_prefix ?>services.php">Marketplace Services</a></li>
        <li><a href="<?= $pages_prefix ?>clients.php">Client Testimonials</a></li>
        <li><a href="<?= $pages_prefix ?>contact.php">Get in Touch</a></li>
      </ul>
    </div>

    <div>
      <h4 class="footer-title">Direct Solutionizer</h4>
      <ul class="footer-contact">
        <li>📞 <a href="tel:+919823941939" style="color: var(--mauve-deep); font-weight:700;">+91 9823941939</a></li>
        <li>💬 <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20need%20assistance." target="_blank" rel="noopener" style="color:#128C7E; font-weight:600;">WhatsApp Solutionizer</a></li>
        <li>📍 Available for Local & Turnkey Projects</li>
        <li>⏱️ Quick Response & Consultation</li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <span>© <?= date('Y') ?> Tradiant Enterprises. Any task - Solutionize. All Rights Reserved.</span>
    <div>               Designed with ❤️ by Lazymoon Digitech <a href="tel:+919168533107">Call Now</a></div>
  </div>
</footer>

<!-- ── PERSISTENT FLOATING CONTACT BUTTONS (BOTTOM RIGHT) ── -->
<div class="floating-contact-stack">
  <!-- WhatsApp Button -->
  <a href="https://wa.me/919823941939?text=Hello%20Tradiant%20Enterprises%2C%20I%20would%20like%20to%20inquire%20about%20your%20services." 
     target="_blank" 
     rel="noopener" 
     class="float-btn float-btn-whatsapp" 
     title="Chat on WhatsApp">
    <div class="float-btn-icon">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
      </svg>
    </div>
    <span class="float-btn-label">WhatsApp Now</span>
  </a>

  <!-- Call Button -->
  <a href="tel:+919823941939" 
     class="float-btn float-btn-phone" 
     title="Call Solutionizer (+91 9823941939)">
    <div class="float-btn-icon">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
      </svg>
    </div>
    <span class="float-btn-label">Call Now</span>
  </a>
</div>

<script src="<?= $root_path ?>assets/js/main.js"></script>
</body>
</html>
