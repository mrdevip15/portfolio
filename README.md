# Portfolio & Agency Web Application

A lightweight, high-performance web platform built with native PHP, SQLite/MySQL, and Tailwind CSS. Features agency landing pages, blog CMS, client billing & invoice management, and an administration dashboard.

---

## 🚀 Quick Start

To run the application locally using PHP's built-in web server:

```powershell
php -S 127.0.0.1:8008 router.php
```

Open [http://127.0.0.1:8008](http://127.0.0.1:8008) in your browser.

> **Note**: Always include `router.php` when running `php -S` to enable clean URL rewrites, dynamic blog slugs, and static asset handling.

---

## 🤖 AI Agent Quick Reference

For AI agents working on this repository, detailed architectural context, route mapping, database configuration, and troubleshooting steps are documented in:

👉 **[AGENTS.md](AGENTS.md)**

---

## 📁 Key Routes

- **Homepage**: `/`
- **Services**: `/jasabikinwebsite`
- **Blog**: `/blog`
- **Billing Portal**: `/billing`
- **Admin Dashboard**: `/admin`

---

## 🛠 Stack

- **Backend**: Native PHP 8.4
- **Database**: SQLite (default: `billing/database.sqlite`) / MySQL
- **Frontend**: HTML5, Tailwind CSS (CDN), Inter & Playfair Display fonts
- **Deployment**: cPanel / Apache (`.htaccess`, `.cpanel.yml`)
