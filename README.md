# 💰 SaveUp — Secure Personal Finance Web Application

> A full-stack personal budgeting app built with **Laravel, Livewire, and Laravel Fortify** — featuring production-grade security, two-factor authentication, real-time financial tracking, and STRIDE threat modeling.

[![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3-pink?style=flat-square)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-3-38bdf8?style=flat-square&logo=tailwindcss)](https://tailwindcss.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](LICENSE)

---

## 📸 Screenshots

> Dashboard · Transactions · Goals · Security Flow

*(Add screenshots or GIF here)*

---

## ✨ Features

### 💳 Core Financial Features
- **Dashboard** — real-time overview of balance, goals, and recent transactions
- **Transaction Tracking** — add, categorize, and filter income/expense entries
- **Savings Goals** — create goals and transfer funds with atomic balance updates
- **User Profile** — manage account settings and preferences

### 🔐 Security Features (Production-Grade)

| Feature | Implementation |
|---|---|
| **Two-Factor Authentication (2FA)** | OTP sent via email, expires in 10 minutes, hashed in DB |
| **Password Hashing** | Bcrypt via `Hash::make()` with complexity rules enforced |
| **SQL Injection Prevention** | Laravel Eloquent ORM — no raw query string concatenation |
| **XSS Protection** | Blade `{{ }}` escaped output on all user-supplied content |
| **Brute Force Protection** | Laravel Fortify rate limiting (5 attempts/min per IP) |
| **CSRF Protection** | Laravel CSRF tokens on every form submission |
| **IDOR Prevention** | `Auth::id()` ownership checks on every database query |
| **Race Condition Safety** | `DB::transaction()` + `lockForUpdate()` on balance changes |
| **Session Security** | HttpOnly cookies, HTTPS enforcement, secure session config |
| **STRIDE Threat Modeling** | Full threat analysis: Spoofing, Tampering, Repudiation, Info Disclosure, DoS, Privilege Escalation |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Frontend** | Blade, Livewire, Tailwind CSS |
| **Backend** | PHP, Laravel 11 |
| **Auth** | Laravel Fortify (2FA, email verification, rate limiting) |
| **Database** | SQLite (dev) / MySQL (prod-ready) |
| **ORM** | Laravel Eloquent |
| **Build** | Vite |

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+

### Installation

```bash
# Clone the repo
git clone https://github.com/saymon2003/SaveUp-Budget-Capstone.git
cd SaveUp-Budget-Capstone

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run build

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations & seed
php artisan migrate --seed

# Start the server
php artisan serve
```

Visit `http://localhost:8000` and register an account. You'll receive an email OTP to verify your 2FA login.

---

## 🔒 Security Architecture

This project applies a **security-by-default** philosophy — security is not a feature added on top, it's baked into every layer.

### Authentication Flow
1. User submits credentials → Fortify validates + rate-limits
2. On success → 6-digit OTP generated, hashed, stored with 10-min expiry, emailed
3. User enters OTP → system checks hash + expiry → session granted
4. All protected routes require `Auth::id()` ownership verification

### Financial Consistency
Balance updates (goals, transactions) are wrapped in `DB::transaction()` with `lockForUpdate()` row locks to prevent race conditions when concurrent requests hit the same records.

### STRIDE Analysis Summary

| Threat | Mitigation |
|---|---|
| **Spoofing** | Bcrypt hashing + email 2FA |
| **Tampering** | CSRF tokens + signed sessions |
| **Repudiation** | Login/logout audit logging with IP + timestamp |
| **Info Disclosure** | HTTPS + HttpOnly cookies + hidden model fields |
| **Denial of Service** | Rate limiting (5 req/min per identity+IP) |
| **Privilege Escalation** | RBAC middleware + user_id binding on all queries |

---

## 👥 Team (Capstone — Winter 2026)

| Name | Role |
|---|---|
| **Anas Abbadi** | Security Framework Implementation (2FA, OTP, rate limiting, IDOR, row locking) |
| Gang Luo | STRIDE Threat Modeling |
| YuTeng Wu | Access Matrix & Reporting |
| Salma Zarrad | Audit Triggers & Database Security |

---

## 📄 License

MIT License — see [LICENSE](LICENSE) for details.
