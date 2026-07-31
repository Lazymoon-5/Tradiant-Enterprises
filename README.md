# Tradiant Enterprises — Website Setup

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
│       └── heroes/            ← PUT YOUR DAD'S IMAGES HERE
│           ├── supervisor.png
│           ├── electrician.png
│           ├── plumber.png
│           └── mason.png
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

### 2. Add Your Dad's Images
Place the 4 (or more) hero images inside:
```
assets/images/heroes/
```
Name them exactly:
- `supervisor.png`
- `electrician.png`
- `plumber.png`
- `mason.png`

These should be **transparent PNG** files (no background).

### 3. Set Folder Permissions
Make sure the `data/` folder is **writable** by the server:
```bash
chmod 755 data/
chmod 644 data/*.json
```

### 4. Access Admin Panel
Go to: `yourdomain.com/admin/login.php`

**Default credentials:**
- Username: `admin`
- Password: `tradiant2024`

> ⚠️ Change the password immediately after first login via Settings.

### 5. Customize Content
- Edit services, clients, and testimonials from the Admin Panel
- Update phone number in `pages/contact.php` and `includes/footer.php`
- Update email in `pages/contact.php`

---

## Requirements
- PHP 7.4 or higher
- Write permissions on the `data/` folder
- No database needed — everything uses JSON files

---

## Hero Image Swap
When a visitor hovers a service item on the home page, the center image of your dad changes to match that role. To add more outfit images:
1. Add the PNG to `assets/images/heroes/`
2. In `index.php`, update the `$hero_images` array to map the service ID to your filename

---

## Admin Panel Features
| Section   | Features                          |
|-----------|-----------------------------------|
| Messages  | View all contact form submissions, delete |
| Services  | Add, Edit, Delete services        |
| Clients   | Add, Edit, Delete testimonials    |
| Settings  | Change username & password        |

---

Built for Tradiant Enterprises. © 2025
