# Afronex Hosting — Payment Verification System
### Project Documentation

**Prepared for:** Internship / Final Year Project Report
**Application Version:** Laravel 13.23 — PHP 8.4 (target) / 8.3 (local) — MongoDB
**Document Date:** August 2026

---

> **About this document.** This is the outline + summary draft of the project report.
> Every chapter is structured with its sub-content table so you can fill in each section
> with full prose later. Items marked `[fill]` are placeholders for you to complete.

---

## Table of Contents

**Chapter 1 — Introduction**
1.1 Background of the Study
1.2 Problem Statement
1.3 Objectives (General & Specific)
1.4 Scope and Limitations
1.5 Significance of the Study
1.6 Methodology Overview
1.7 Report Organization

**Chapter 2 — Literature Review**
2.1 Overview of Web-Based Service Sales and Payment Systems
2.2 Review of Existing Systems
2.3 Payment Verification Approaches (Manual vs Automated)
2.4 Two-Factor Authentication and OTP in Web Apps
2.5 Multi-Language Support in Web Applications
2.6 Adopted Technology Stack

**Chapter 3 — System Analysis and Requirements**
3.1 Feasibility Study
3.2 Functional Requirements
3.3 Non-Functional Requirements
3.4 User Roles and Actors
3.5 Use Case Model
3.6 System Constraints

**Chapter 4 — System Design**
4.1 System Architecture
4.2 Module Design
4.3 Database Design (Entity-Relationship)
4.4 API / Route Design
4.5 Security Design
4.6 User Interface / Experience Design

**Chapter 5 — System Implementation**
5.1 Development Environment and Tools
5.2 Authentication and OTP (2FA) Implementation
5.3 Ordering and Checkout Flow
5.4 Payment Slip Upload and Verification Workflow
5.5 Admin Panel and Multi-Tenancy (Business Management)
5.6 Multilingual Support
5.7 Code Structure (Key Files)

**Chapter 6 — Testing**
6.1 Testing Strategy
6.2 Unit Testing
6.3 Feature / Integration Testing
6.4 Manual Testing (User Acceptance)
6.5 Test Results Summary

**Chapter 7 — Deployment and Operations**
7.1 Docker Containerization
7.2 Render (Blueprint) Deployment
7.3 Environment Configuration
7.4 Database (MongoDB Atlas) Setup
7.5 Troubleshooting and Maintenance
7.6 Monitoring Roadmap

**Chapter 8 — Conclusion and Future Work**
8.1 Summary of Achievements
8.2 Challenges Faced
8.3 Recommendations
8.4 Future Enhancements

**Appendices**
Appendix A — Glossary
Appendix B — Installation and Run Guide
Appendix C — Artifact Repository Reference

---

## Chapter 1 — Introduction

### 1.1 Background of the Study
Explains the shift of Ethiopian hosting / domain and service providers from manual
(order-by-phone, in-person payment) operations to an online storefront. Modern platforms
let customers browse packages, order online, and pay via bank transfer while **verifying
the payment through an uploaded bank transfer slip**. *(Expand with the local business
context and motivation.)*

### 1.2 Problem Statement
- Customers cannot order hosting/domain services without visiting the office or calling.
- Admins manually track bank transfer payments and confirm them with no shared record.
- No centralized dashboard for packages, orders, customers, and payment evidence.
- No customer portal to follow their own order/payment status.
- Trust gap: bank transfer payments are hard to prove without a slip-verification step.

### 1.3 Objectives (General & Specific)
- **General:** Build an online payment-verification platform for hosting/service providers.
- **Specific:**
  - Allow customers to register, browse packages, and place orders online.
  - Let customers upload bank-transfer payment slips for verification.
  - Provide an admin dashboard to process (approve/reject) payment verifications.
  - Support multiple businesses (multi-tenancy) with their own packages and payment methods.
  - Secure access with phone OTP two-factor authentication.
  - Provide Amharic + English interfaces.

### 1.4 Scope and Limitations
- Covers web storefront, ordering, payment verification, admin panel, auth/OTP, multi-tenancy.
- Excludes: real bank/telecom API integrations (simulated OTP via `log` channel), outsourced
mail/SMS gateways, and automated bank reconciliation.

### 1.5 Significance of the Study
Benefits to businesses (faster confirmation, organized records), to customers (self-service
ordering and status tracking), and as a learning reference for Laravel/MongoDB development.

### 1.6 Methodology Overview
Survey of existing manual process → requirements gathering → Agile/iterative development →
Laravel MVC implementation → MongoDB data model → feature testing → Docker/Render deployment.

### 1.7 Report Organization
Airline summary of each chapter and how the document flows from background to conclusion.

---

## Chapter 2 — Literature Review

### 2.1 Overview of Web-Based Service Sales and Payment Systems
E-commerce and digital service selling models; the role of storefronts, catalogs, and carts.

### 2.2 Review of Existing Systems
Compare at least two related systems (e.g., generic hosting platforms, local provider
sites, money-transfer/apps) — what they do well and their gaps that this project fills.

### 2.3 Payment Verification Approaches (Manual vs Automated)
How bank-transfer payments are confirmed: manual phone confirmation, receipt upload +
admin review (what this project implements), vs future direct bank/aggregator APIs
(TeleBirr, CBE Birr, Chapa, etc.).

### 2.4 Two-Factor Authentication and OTP in Web Apps
Why OTP on login (plus Laravel Sanctum tokens) raises account security; simulated OTP
delivery via the `log` channel for development. **References:** Laravel Sanctum docs,
NIST OTP guidance.

### 2.5 Multi-Language Support in Web Applications
Localization patterns (Laravel `lang` files for `en`/`am`), Google Translate
integration, and language persistence per user (LanguageController).

### 2.6 Adopted Technology Stack
- **Backend framework:** Laravel 13.23 (MVC, Eloquent, middleware, queue/cache/file drivers)
- **Database:** MongoDB via `mongodb/laravel-mongodb` (MongoDB Atlas in production)
- **Frontend:** Blade templates + Tailwind CSS 4 + Vite 8
- **Auth:** Laravel Sanctum + phone OTP (AuthController, `OtpService`)
- **Hosting/Deploy:** Docker, Nginx, Render Blueprint (`render.yaml`).

---

## Chapter 3 — System Analysis and Requirements

### 3.1 Feasibility Study
Technical (Laravel + MongoDB readily available), operational (admins can process verifications
from any browser), economic (Docker + Render free/cheap tier, open-source stack).

### 3.2 Functional Requirements
- Customer registration/login (form + modal/AJAX), vendor registration.
- Login OTP (2FA) send/verify/resend (form + AJAX).
- Browse packages (`hosting`/`services`/domain types, grouped by provider).
- Place service / domain / level-based orders (multi-step checkout).
- Upload bank-transfer payment slips and submit verification.
- Check payment/order status (`/payment-status`).
- Customer dashboard (own orders and verifications).
- Admin dashboard with stats and notifications.
- Admin CRUD: businesses (super admin), packages, payment methods, orders, users.
- Business approval/rejection workflow (`approve`/`reject`).
- Payment verification processing: pending list, view slip, approve/reject.
- Support/contact form submission.
- Language switching (Amharic / English).
- Multi-tenancy: customers enter through `/b/{business}`.

### 3.3 Non-Functional Requirements
- **Security:** role middleware (`auth`, `admin`, `super_admin`), encrypted sessions,
  APP_KEY, HTTPS/trusted proxies, OTP verification.
- **Performance:** < 2s typical page load [verify]; file/db caching considerations.
- **Usability:** multilingual, responsive, glassmorphism UI in dark/light mode.
- **Reliability:** app boots even if the database is unreachable (friendly error page,
  migrations retried on next boot).
- **Portability:** containerized (Dockerfile + nginx.conf + start.sh).

### 3.4 User Roles and Actors
| Actor          | Description                                        | Capabilities |
|----------------|----------------------------------------------------|--------------|
| Guest          | Unauthenticated visitor                            | Browse, register, login |
| Customer       | Registered user                                    | Order, pay, upload slip, dashboard |
| Admin          | Platform/business administrator                    | Manage packages, orders, users, verifications |
| Super Admin    | Platform owner                                     | Manage/approve businesses |

### 3.5 Use Case Model
Draw use-case diagrams for each actor: *(insert diagrams here — plantuml or images)*.
Key use cases: Register, Login+OTP, Browse Packages, Place Order, Upload Slip, Process
Verification, Manage Business, Switch Language.

### 3.6 System Constraints
- Mobile money / bank APIs not available in scope (OTP simulated via log).
- Email/SMS gateways stubbed (`MAIL_MAILER=log`).
- Free-tier ephemeral storage → production uploads must use object storage (S3/R2).

---

## Chapter 4 — System Design

### 4.1 System Architecture
Three-tier web architecture: **Client** (browser + Blade/Tailwind/Vite) → **Application**
(Laravel MVC: routes → controllers → services/models → views) → **Data** (MongoDB via
Eloquent-like `mongodb/laravel-mongodb` models). Include an architecture diagram.

### 4.2 Module Design
| Module | Key controllers | Description |
|--------|-----------------|-------------|
| Auth / OTP | `Auth\AuthController`, `OtpService` | Register/login/vendor register, modal AJAX auth, OTP send/verify, login 2FA |
| Catalog | `PackageController` | Public package listing grouped by type/provider |
| Orders | `OrderController` | Multi-step ordering incl. domain/level/service flows |
| Payments | `PaymentVerificationController` | Slip upload, verification submit, status check |
| Customer | `CustomerDashboardController` | Customer dashboard |
| Admin | `Admin\*Controller` (Admin, Package, Order, Customer, PaymentMethod, Business) | Full back-office CRUD + verification processing |
| Support | `SupportController` | Contact/support form |
| Localization | `LanguageController` | Language switch |

### 4.3 Database Design (Entity-Relationship)
MongoDB collections modelled by 32 migrations. Central models:
- `Customer` / `User` (roles: customer, admin, super_admin)
- `Business` (tenancy root; status pending/approved/rejected)
- `Package` (type: hosting/services; provider; active flag)
- `Order` (customer, package, business_id, status)
- `PaymentMethod` (bank details; `is_active`, scoped to type/provider/package)
- `Payment` — as used by the payment/verification flow
- `PaymentVerification` (order, slip path, status, business_id)
- `PhoneVerification` (OTP codes)
- `AdminNotification` (dashboard alerts; business_id)
Include an ER/diagram (MongoDB document relationships).

### 4.4 API / Route Design
Summarise `routes/web.php` route groups:
- Public: `/`, `/packages`, `/support`, `/how-to-*`, `/contact`, `/payment-verify`, `/domains/*`
- Auth: `/login*`, `/register*`, `/otp/*`, `/ajax-*`, `/vendor/register`
- Customer: `/dashboard`, `/order/*` (step-1..3, place-order, confirm/payment, success)
- Business entry: `/b/{business}`
- Admin: `/admin/{dashboard,businesses,packages,orders,users,payment-methods,verifications/*,notifications/*}`
- Misc: `/language/switch`

### 4.5 Security Design
- Role middleware chain: `auth` → `admin` → `super_admin`.
- OTP 2FA on login (send/verify/resend; AJAX variants).
- Trusted proxies + HTTPS handling for Render; secure cookies; SESSION_ENCRYPT.
- Environment secrets via `.env` (APP_KEY, MONGODB credentials); `MONGODB_PASSWORD` as a Render secret.

### 4.6 User Interface / Experience Design
Glassmorphism UI with dark/light mode, multilingual instant translation, admin sidebar,
order/payment status steps, yellow "Simulation OTP" banner in development. *(Add screenshots.)*

---

## Chapter 5 — System Implementation

### 5.1 Development Environment and Tools
PHP 8.3 local / 8.4 container target, Composer, Node/Vite, MongoDB driver, VS Code;
Laravel 13.23; Windows local + Docker on Render.

### 5.2 Authentication and OTP (2FA) Implementation
- Form + AJAX (`/ajax-register`, `/ajax-login`) auth.
- `OtpService` sends/validates phone OTP (`PhoneVerification` collection); dev mode writes
  `debug_otp` to the log channel with an in-page simulation banner.
- Sanctum-based token/auth under the hood; role flags on `Customer`.

### 5.3 Ordering and Checkout Flow
- `OrderController`: step-1 (package) → step-2 (domain or level) → step-3 (details) →
  `place-order` → step-4 (payment) → confirm → success.
- Yegara (business-entry) flow with its own store/place controllers.

### 5.4 Payment Slip Upload and Verification Workflow
- `PaymentVerificationController::submit` stores the slip (local/Flysystem; S3/R2 for prod).
- Admin: pending list → view slip → process (approve/reject) → notification to customer.
- Public status check at `/payment-status/{order_id}`.

### 5.5 Admin Panel and Multi-Tenancy (Business Management)
- Businesses carry all resources via `business_id` (orders, packages, payment methods,
  verifications, notifications).
- `Admin*Controller` CRUD tables + delete modals; super-admin approve/reject flow.

### 5.6 Multilingual Support
- `lang/en` + `lang/am` files; Google Translate for additional languages;
  `LanguageController` persists user preference.

### 5.7 Code Structure (Key Files)
| Area | Files |
|------|-------|
| Routes | `routes/web.php` |
| Auth | `app/Http/Controllers/Auth/AuthController.php`, `app/Services/OtpService.php` |
| Orders | `OrderController.php`, `PaymentVerificationController.php` |
| Admin | `app/Http/Controllers/Admin/*` |
| Models | `app/Models/{Customer,Business,Package,Order,Payment,PaymentMethod,PaymentVerification,PhoneVerification,AdminNotification,User}.php` |
| Migrations | `database/migrations/*` (32 files) |
| Views | `resources/views/{admin,auth,customer,domains,howto,layouts,orders,packages,payments,partials,purchase}/*.blade.php` |

---

## Chapter 6 — Testing

### 6.1 Testing Strategy
Laravel’s built-in PHPUnit + feature/unit tests; manual browser checks for UI flows
(register → login OTP → order → upload slip → admin approve).

### 6.2 Unit Testing
- `OtpService` code generation/validation.
- Model scopes (e.g., `Package active`, `PaymentMethod forType`).

### 6.3 Feature / Integration Testing
- Auth register/login/OTP happy + error paths.
- Order placement and payment verification lifecycle.
- Admin processing (approve/reject) updates status + notifications.
*(List the actual `tests/*` cases and run results here.)*

### 6.4 Manual Testing (User Acceptance)
Walkthrough of: multilingual switching, dark/light mode, slip upload, admin CRUD,
payment status page, boot-without-DB fallback.

### 6.5 Test Results Summary
Table: test case → expected → actual → pass/fail. *(fill in from `php artisan test` output.)*

---

## Chapter 7 — Deployment and Operations

### 7.1 Docker Containerization
`Dockerfile` (PHP 8.4, composer install before copy patterns), `nginx.conf`, `start.sh`
(env setup, framework bootstrap, supervisord-less single process). App copies all files
before `composer install` so `package:discover` works during build.

### 7.2 Render (Blueprint) Deployment
- `render.yaml`: web service + env vars (APP_URL, APP_KEY, MongoDB Atlas DSN, DB_CONNECTION,
  file-based session/cache/queue, `LOG_CHANNEL=stderr`).
- Two paths: **Blueprint** (recommended) or **Docker Web Service**; health check path `/`.
- Note: free-tier PostgreSQL is no longer offered — this project uses **MongoDB Atlas** instead.

### 7.3 Environment Configuration
Required variables (APP_ENV, APP_KEY, APP_URL, DB_CONNECTION, MONGODB_DSN/DATABASE/USERNAME/
PASSWORD as secret, SESSION_DRIVER, CACHE_STORE, QUEUE_CONNECTION, LOG_CHANNEL, MAIL_MAILER).

### 7.4 Database (MongoDB Atlas) Setup
Create Atlas cluster → network access (0.0.0.0/0) → DB user → replicate the same
`MONGODB_*` values in Render env; migrations run on first boot.

### 7.5 Troubleshooting and Maintenance
- 500 on boot → check APP_KEY/`config:cache`; console shows raw error when `APP_DEBUG=true`.
- Uploads vanish on redeploy → configure object storage (S3/R2).
- OTP not delivered → verify `LOG_CHANNEL` shows `debug_otp` in dev.

### 7.6 Monitoring Roadmap
Add error tracking (Sentry/Laravel Telescope), uptime checks, and database backups on Atlas.

---

## Chapter 8 — Conclusion and Future Work

### 8.1 Summary of Achievements
A complete Laravel + MongoDB platform delivering online ordering, bank-slip payment
verification, OTP-secured accounts, an admin back-office, multi-tenancy, and multilingual
UI, containerized and deployed on Render.

### 8.2 Challenges Faced
MongoDB driver/build compatibility, free-tier hosting limits, ephemeral file storage,
OTP delivery without a real SMS gateway, config caching pitfalls on deployment.

### 8.3 Recommendations
- Move SMS to a real gateway (Telegram/Chapa SMS) and email to SMTP.
- Automate bank/aggregator payment confirmation (TeleBirr / CBE Birr / Chapa APIs).
- Add file object storage (R2/S3) and automated backups.

### 8.4 Future Enhancements
Real-time notifications (WebSockets/Pusher), order tracking, invoice/PDF generation,
automated reconciliation, analytics dashboard, mobile app/PWA.

---

## Appendices

### Appendix A — Glossary
OTP, 2FA, Slip, Multi-tenancy, Blueprint (Render), Vercel, Atlas, etc. *(define terms used
in the report)*.

### Appendix B — Installation and Run Guide
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# set MONGODB_DSN / MONGODB_DATABASE in .env

php artisan migrate --force
php artisan db:seed --force
npm run build          # or: npm run dev

# Local server (public/ entry point — required on Windows):
php -S 127.0.0.1:8000 -t public

# Create the admin account:
php artisan admin:create --email=you@example.com --name="Admin" --password='<12+ char password>'
```

### Appendix C — Artifact Repository Reference
GitHub: `https://github.com/ananchali/Intership_project` — branches `main`, key deploy
artifacts (`render.yaml`, `Dockerfile`, `start.sh`, `nginx.conf`).

---

*End of document outline. Fill each section with full prose as required by your
institution’s formatting rules (cover page, declaration, acknowledgment, references).*