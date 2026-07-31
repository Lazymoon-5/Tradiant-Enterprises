# Tradiant Enterprises

Tradiant Enterprises provides professional local services to clients.

## Folder Structure
```
tradiant/
├── index.php                  ← Home / Landing Page
├── pages/
│   ├── about.php              ← About Me
│   ├── services.php           ← Works I Provide
│   ├── clients.php            ← Clients & Testimonials
│   └── contact.php            ← Contact Now
├── admin/
│   ├── login.php              ← Admin Login
│   ├── dashboard.php          ← Admin Dashboard
│   ├── messages.php           ← View & Delete Contact Messages
│   ├── services.php           ← Add / Edit / Delete Services
│   ├── clients.php            ← Add / Edit / Delete Clients
│   ├── settings.php           ← Change Admin Password
│   └── logout.php
├── api/
│   └── contact.php            ← Contact Form Handler
├── assets/
│   ├── css/style.css
│   ├── js/main.js
│   └── images/
│       └── heroes/            ← Hero images
├── data/                      ← JSON data files (auto-managed)
│   ├── services.json
│   ├── clients.json
│   ├── messages.json
│   └── admin.json
└── includes/
    ├── header.php
    └── footer.php
```

---

## Setup Steps

### 1. Upload to Server
Upload the entire `tradiant/` folder to your server's `public_html` or `www` directory.

### 2. Hero Images
Place the hero images inside:
```
assets/images/heroes/
```
Name them:
- `supervisor.png`
- `electrician.png`
- `plumber.png`
- `mason.png`

### 3. Set Folder Permissions
Make sure the `data/` folder is **writable** by the server:
```bash
chmod 755 data/
chmod 644 data/*.json
```

### 4. Access Admin Panel
Go to: `yourdomain.com/admin/login.php`

---

## Requirements
- PHP 7.4 or higher
- Write permissions on the `data/` folder
- No database needed — everything uses JSON files

---

Built for Tradiant Enterprises. © 2025

