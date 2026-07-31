// ── MAIN JAVASCRIPT FOR TRADIANT ENTERPRISES ──

document.addEventListener('DOMContentLoaded', () => {
  initNav();
  initHero();
  initContactForm();
});

// ── NAVIGATION & HAMBURGER ──
function initNav() {
  const hamburger = document.querySelector('.hamburger');
  const navLinks  = document.querySelector('.nav-links');
  
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('open');
      navLinks.classList.toggle('open');
    });

    // Close mobile nav on link click
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        hamburger.classList.remove('open');
        navLinks.classList.remove('open');
      });
    });
  }

  // Active page indicator highlight based on current URL path
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.nav-links a').forEach(a => {
    const href = a.getAttribute('href');
    if (href && (href.endsWith(currentPath) || (currentPath === '' && href.endsWith('index.php')))) {
      a.classList.add('active');
    }
  });
}

// ── CREATIVE HERO IMAGE SWAPPER & INTERACTIVE STAGE ──
function initHero() {
  const svcItems = document.querySelectorAll('.svc-item');
  const heroImgs = document.querySelectorAll('.figure-img-wrap img');
  const roleTitle = document.getElementById('heroRoleTitle');
  const roleSub = document.getElementById('heroRoleSub');
  const heroStage = document.querySelector('.hero-stage');

  if (!svcItems.length) return;

  // Preload images to prevent lag on hover
  heroImgs.forEach(img => {
    if (img.src) {
      const p = new Image();
      p.src = img.src;
    }
  });

  const activateService = (item) => {
    svcItems.forEach(i => i.classList.remove('active'));
    item.classList.add('active');

    const role = item.getAttribute('data-role');
    const sub  = item.getAttribute('data-sub');
    const imgId = item.getAttribute('data-img');

    // Hide all images
    heroImgs.forEach(img => {
      img.classList.remove('visible');
      img.classList.add('hidden');
    });

    // Find target image or fallback to supervisor/default
    let target = document.getElementById('img-' + imgId);
    if (!target) {
      target = document.getElementById('img-supervisor') || document.getElementById('img-default');
    }

    if (target) {
      target.classList.remove('hidden');
      target.classList.add('visible');
    }

    // Update text badge with smooth fade
    if (roleTitle) {
      roleTitle.style.opacity = '0';
      setTimeout(() => {
        roleTitle.textContent = role;
        roleTitle.style.opacity = '1';
      }, 150);
    }

    if (roleSub) {
      roleSub.style.opacity = '0';
      setTimeout(() => {
        roleSub.textContent = sub;
        roleSub.style.opacity = '1';
      }, 150);
    }
  };

  const resetDefault = () => {
    const defaultItem = svcItems[0];
    if (defaultItem) {
      activateService(defaultItem);
    }
  };

  // Add mouseenter and touchstart event listeners
  svcItems.forEach(item => {
    item.addEventListener('mouseenter', () => activateService(item));
    item.addEventListener('touchstart', (e) => {
      activateService(item);
    }, { passive: true });
  });

  // Reset to default when mouse leaves the hero stage
  if (heroStage) {
    heroStage.addEventListener('mouseleave', () => resetDefault());
  }
}

// ── API CONTACT FORM HANDLER ──
function initContactForm() {
  const form = document.getElementById('contactForm');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = form.querySelector('button[type="submit"]');
    const originalText = btn ? btn.textContent : 'Send Message';
    
    if (btn) {
      btn.disabled = true;
      btn.textContent = 'Processing Inquiries...';
    }

    try {
      const formData = new FormData(form);
      const res = await fetch('../api/contact.php', {
        method: 'POST',
        body: formData
      });
      const json = await res.json();

      if (json.success) {
        form.style.display = 'none';
        const successBox = document.getElementById('formSuccess');
        if (successBox) successBox.style.display = 'block';
      } else {
        alert(json.message || 'Unable to submit form. Please call +91 9823941939 directly.');
        if (btn) {
          btn.disabled = false;
          btn.textContent = originalText;
        }
      }
    } catch (err) {
      console.error('Submission error:', err);
      alert('Connection error. Please call +91 9823941939 or WhatsApp us directly.');
      if (btn) {
        btn.disabled = false;
        btn.textContent = originalText;
      }
    }
  });
}
