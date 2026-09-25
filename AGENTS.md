# Agent Run & Development Guide

This document contains essential context and instructions for AI agents (and developers) to quickly start, run, test, and develop this codebase.

---

## ⚡ Quick Start: Running the Server

Always start the PHP built-in server with `router.php` so rewrite rules and clean URLs work properly:

```powershell
# From the project root (d:\WORK\portfolio):
php -S 127.0.0.1:8008 router.php
```

> **Important**:
> - **Always use `router.php`**: Running without `router.php` breaks clean URLs, blog post slug rewrites, and subfolder routing.
> - **Port Selection**: Ports `8000` and `8080` are commonly occupied on this machine by system processes. Recommended ports: `8008`, `8888`, or `3000`.

---

## 🧭 Key Endpoints & Routes

When the server is running on `http://127.0.0.1:8008`:

| Route | Source File | Description |
|---|---|---|
| `/` | `index.php` | Main portfolio / agency landing page |
| `/jasabikinwebsite` | `jasabikinwebsite/index.php` | Services landing page |
| `/blog` | `blog/index.php` | Blog index listing |
| `/blog/{slug}` | `blog/post.php?slug={slug}` | Blog post detail (routed by `router.php`) |
| `/billing` | `billing/index.php` | Billing management & client invoice system |
| `/billing/view?id={id}` | `billing/view.php` | Public/client invoice viewer |
| `/admin` | `admin/index.php` | Admin CMS dashboard (posts, projects, testimonials) |
| `/admin/posts` | `admin/posts.php` | Manage blog posts |
| `/admin/projects` | `admin/projects.php` | Manage portfolio projects |
| `/admin/testimonials` | `admin/testimonials.php` | Manage client testimonials |
| `/admin/settings` | `admin/settings.php` | Site settings & configuration |

---

## 🛠 Tech Stack & Architecture

- **Runtime**: Native PHP 8.4+ (No Composer, no framework overhead).
- **Styling**: Tailwind CSS via CDN + custom styles inside `includes/header.php`.
- **Database**:
  - Configured in `.env`: `USE_SQLITE=true`.
  - SQLite database file: `billing/database.sqlite`.
  - Connection helper: `billing/db.php` (`get_db_connection()`).
  - Supports MySQL fallback if configured in `.env`.
- **Production Server**: Apache via `.htaccess` (cPanel deployment configured in `.cpanel.yml`).
- **Local Dev Server**: Handled via `router.php`.

---

## 🗄 Database & Migrations

- **Database file**: `billing/database.sqlite` (pre-seeded with all tables).
- **Run Migrations**:
  ```powershell
  php billing/migrate.php
  ```
- **Run Seeds**:
  ```powershell
  php billing/seed.php
  ```

---

## ⚙️ Environment & PHP Extensions

Ensure the following PHP modules are enabled in `php -m` (configured in `C:\php8.4\php.ini`):
- `pdo_sqlite`
- `sqlite3`
- `pdo_mysql` (optional, for MySQL)
- `mysqli` (optional, for MySQL)
- `fileinfo`
- `mbstring`
- `openssl`
- `curl`

---

## ⚠️ Gotchas & Troubleshooting

1. **Clean URL Routing**:
   If an endpoint returns 404 or fails to resolve, verify that the server was launched with `router.php`.
2. **Session / Auth**:
   Admin dashboard (`/admin`) shares session authentication with the billing module (`$_SESSION['billing_auth']`).
3. **Database queries**:
   When writing SQL queries, note that the project runs SQLite locally. Avoid MySQL-only syntax (e.g. use `INSERT OR IGNORE` or standard cross-compatible ANSI SQL).
