# 🌟 Loyalty Points System — MVC Foundation

> A clean, modular loyalty points system for an e-commerce platform — built with PHP MVC architecture, Twig templates, SOLID principles, and a complete rewards redemption flow.

![PHP](https://img.shields.io/badge/PHP%208-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Twig](https://img.shields.io/badge/Twig-bacb00?style=flat-square&logo=symfony&logoColor=black)
![Composer](https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white)
![OOP](https://img.shields.io/badge/OOP-SOLID-green?style=flat-square)

---

## ✨ Features

### 🔐 Authentication
- User registration and login with secure PHP sessions
- Password hashing with `bcrypt`
- Session persistence and protected routes
- Clean logout flow

### 📊 Points System
- Automatic points calculation: **10 points per 100€ spent**
- Real-time points balance on dashboard
- Full transaction history (earned, redeemed, expired)
- `PointsCalculator` service — single responsibility, no DB access

### 🎁 Rewards Catalog
- Browse available rewards (e.g. 500 pts = 5€ voucher, 1000 pts = free shipping)
- Redeem points against a reward
- Confirmation screen after redemption
- Stock management per reward

### 📈 Dashboard
- Current points balance
- Recent transaction history
- Quick access to the rewards catalog
- Navigation reflects authentication state

---

## 🏗️ MVC Architecture

```
src/
├── Controllers/     # Handle HTTP requests, delegate to models
├── Models/          # Business logic + DB interactions (PDO)
├── Views/           # Twig templates — zero PHP logic
├── Core/            # Router, Front Controller, base classes
├── Services/        # PointsCalculator and business rules
└── Entities/        # Domain objects (User, Transaction, Reward)
Config/              # DB config, app settings
Tests/               # Validation tests
public/              # Front controller entry point (index.php)
vendor/              # Composer dependencies (Twig)
```

### Clean Routes

| Route | Controller |
|---|---|
| `GET/POST /register` | `AuthController::register()` |
| `GET/POST /login` | `AuthController::login()` |
| `GET /logout` | `AuthController::logout()` |
| `GET /dashboard` | `DashboardController::index()` |
| `GET /points/history` | `PointsController::history()` |
| `GET /rewards` | `RewardsController::index()` |
| `POST /rewards/redeem/{id}` | `RewardsController::redeem()` |

---

## 🛡️ SOLID Principles

| Principle | Implementation |
|---|---|
| **S** — Single Responsibility | `PointsCalculator` only calculates, never saves |
| **O** — Open/Closed | Models extend a base `AbstractModel` |
| **D** — Dependency Inversion | Controllers receive Model instances via constructor |

---

## 🛠 Tech Stack

| Technology | Usage |
|---|---|
| PHP 8 OOP | Backend logic, routing, session management |
| MySQL + PDO | Prepared statements, 3-table schema |
| Twig | Template engine — `{{ }}`, `{% %}` only, zero PHP |
| Composer | Autoloading (PSR-4) + dependency management |
| `.htaccess` | Clean URLs via URL rewriting |

---

## 🚀 Getting Started

```bash
git clone https://github.com/lioubiarabi/Loyalty_Points_System_MVC_Foundation.git
cd Loyalty_Points_System_MVC_Foundation
composer install
```

1. Import the database schema (see `Config/` or `SQL_file.sql`)
2. Set your DB credentials in `Config/`
3. Point your web server to `public/` as the document root
4. Open `http://localhost/Loyalty_Points_System_MVC_Foundation/public`

### Test Credentials
```
Email:    test@shopeasy.com
Password: password123
```

---

## 🗄️ Database Schema

```sql
users              -- id, email, password_hash, name, total_points
points_transactions -- id, user_id, type (earned/redeemed/expired), amount, balance_after
rewards            -- id, name, points_required, description, stock
```

---

## 🎯 Project Context

Built for **ShopEasy**, an e-commerce platform that needed to replace messy procedural spaghetti code with a clean, scalable MVC foundation for their loyalty program.

**Duration:** 8 days (Jan 8–19, 2026)

---

## 💡 What I Learned

- Structuring a full PHP application with the MVC pattern from scratch
- Building a custom router with clean URLs via `.htaccess`
- Using Twig as a template engine with zero PHP in views
- Applying SOLID principles with dependency injection
- Separating business logic (Services) from data access (Models)
- PSR-4 autoloading with Composer namespaces

---

## 👤 Author

**Lioubi Arabi** — Youcode Web Development Student  
[![GitHub](https://img.shields.io/badge/GitHub-lioubiarabi-181717?style=flat-square&logo=github)](https://github.com/lioubiarabi)

---

*Clean architecture — because spaghetti code has no place in production 🌟*
