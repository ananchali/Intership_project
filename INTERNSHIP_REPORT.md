# SOFTWARE ENGINEERING INTERNSHIP REPORT

## Afronex Hosting — Payment Verification System

**Internship Report Outline — Department of Software Engineering**
Dire Dawa University · Institute of Technology · School of Computing

---

## COVER PAGE

- **University name:** Dire Dawa University
- **School / College:** Institute of Technology
- **Department:** Software Engineering
- **Title of the report:** *"Software Engineering Internship Presentation — Afronex Hosting Payment Verification System"*
- **Student name:** `[Your Full Name]`
- **Student ID number:** `[Your ID Number]`
- **Internship company / organization:** `[Company / Organization Name]`
- **Internship period:** `[Start Date] — [End Date]`
- **Date of submission:** `[Submission Date]`
- **Contact (as per guide):** `[E-mail]`, `[Phone]`, `[Fax / P.O.Box]`, Dire Dawa, Ethiopia

---

## Table of Contents

**PART ONE: REPORT**

1. [Report Cover Page](#1-report-cover-page)
2. [Acknowledgment](#2-acknowledgment)
3. [List of Acronyms](#3-list-of-acronyms)
4. [Table of Contents](#table-of-contents)
5. [Introduction](#5-introduction)
6. [Company Background](#6-company-background)
   - 6.1 Industry, Products and Services Overview
   - 6.2 Organizational Structure
6. [Internship Activities](#6-internship-activities)
   - 6.0 Role and Responsibilities
   - 6.1 Basic Activities of the Organization
   - 6.2 List of Projects Actively Participated In
   - 6.3 Detailed Description of Tasks and Projects
   - 6.4 Tools, Programming Languages and Frameworks Used
   - 6.5 Approaches or Processes Followed (Agile / Scrum)
   - 6.6 Examples of Problems Solved or Features Developed
7. [Technical Skills and Knowledge Utilized](#7-technical-skills-and-knowledge-utilized)
8. [Collaboration and Teamwork](#8-collaboration-and-teamwork)
9. [Project Highlights](#9-project-highlights)
10. [Learning and Growth](#10-learning-and-growth)
11. [Challenges Faced and Solutions](#11-challenges-faced-and-solutions)
12. [Contribution to the Organization](#12-contribution-to-the-organization)
13. [Conclusion & Recommendations](#13-conclusion--recommendations)
14. [References](#14-references)
15. [Appendices (Optional)](#15-appendices-optional)

**PART TWO: IMPLEMENTATION** (Presentation Slides and Project Demo)

- [Presentation Outline](#part-two-implementation)

---

## 2. Acknowledgment

`[Optional — short thanks to the internship company, supervisor, classmates, and the
organization. Fill in with the actual names.]`

---

## 3. List of Acronyms

| Acronym | Meaning |
|---------|---------|
| API | Application Programming Interface |
| CRUD | Create, Read, Update, Delete |
| DB | Database |
| E.C. | Ethiopian Calendar |
| ER | Entity–Relationship |
| HTTP(S) | Hypertext Transfer Protocol (Secure) |
| MVC | Model–View–Controller |
| OTP | One-Time Password |
| PHP | Hypertext Preprocessor |
| SDK | Software Development Kit |
| SMS | Short Message Service |
| 2FA | Two-Factor Authentication |
| UI / UX | User Interface / User Experience |
| VCS | Version Control System |

---

## 5. Introduction

### Purpose of the internship
The purpose of this internship was to apply software engineering knowledge gained in the
department to a real-world web application development project. The intern participated in
designing, building, testing, and deploying *Afronex Hosting — Payment Verification System*,
an online platform that lets Ethiopian hosting/domain and service providers sell packages,
receive bank-transfer payments, and verify each payment through an uploaded bank-slip.

### How it relates to your program of study
The project exercises core Software Engineering competencies covered in the curriculum:

- **Object Oriented Programming** and **Web Development** (PHP, Laravel, Blade).
- **Database design** (MongoDB document modeling via 32 migrations).
- **Requirements analysis and system design** (use cases, modules, ER/logical design).
- **Software quality and testing** (PHPUnit feature tests, manual user-acceptance tests).
- **Software project management** (version control with Git/GitHub, iterative delivery).
- **Networking and deployment** (Docker containerization, Render cloud deployment).

---

## 6. Company Background

### 6.1 Industry, Products and Services Overview
*Provide a brief overview of the industry and of the company/organization where the student
interned — i.e., the hosting and web-services industry, what the organization sells
(hosting packages, domain names, and related services in Ethiopia), and where the intern
was placed. Fill in the real company details in `[brackets]`. If the project was developed
as an academic/commercial prototype, describe the target sector instead.*

The system itself targets hosting and related digital-service providers:

- **Products:** web hosting packages, domain registrations, and value-added services.
- **Services:** online package browsing, ordering, bank-transfer payment with slip upload,
  admin-side payment verification, and customer order/status tracking.
- **Platform position:** a multi-business storefront (each registered business gets its own
  packages, payment methods, orders, and verification queue).

### 6.2 Organizational structure (where your team fits)
Customers interact only with the storefront; **admins** operate the back office
(packages, orders, users, payment verification) and are organized with **role levels**:
`customer`, `admin`, and `super_admin` (platform owner who manages and approves businesses).
`[Add the org chart of the hosting company and where the development intern was placed.]`

---

## 6. Internship Activities

### 6.0 Role and Responsibilities
The intern took the role of **full-stack developer**, responsible for:
building the Laravel backend, designing the MongoDB data model, implementing
authentication and OTP two-factor login, the ordering and payment-verification workflow,
the admin panel, multilingual support, and containerized deployment.

### 6.1 Basic Activities of the Organization
- Receiving and processing customer orders for hosting/domain/service packages.
- Bank-transfer payment collection and **manual slip verification** (previously paper/phone-based).
- Managing package catalogs, payment methods, and customer accounts.
- Customer support and status follow-up.

### 6.2 List of Projects Actively Participated In
1. **Afronex Hosting — Payment Verification System** (main internship project).

### 6.3 Detailed Description of Tasks and Projects
Main tasks performed during the internship:

- **Project setup:** Laravel 13 project scaffolding, environment configuration
  (`.env`, `config/*`), MongoDB integration via `mongodb/laravel-mongodb`.
- **Authentication module:** registration/login (form + AJAX modal flows), vendor
  registration, and **phone OTP (2FA)** send/verify/resend using the `OtpService`,
  with a simulated OTP banner in development.
- **Catalog module:** package management grouped by type (`hosting`, `services`,
  domains) and by provider; PackageController + admin CRUD.
- **Ordering module:** multi-step checkout (`OrderController`) — package →
  domain/level → details → place order → payment → confirm → success, plus a
  business-specific entry flow (`/b/{business}`).
- **Payment verification module:** bank-slip upload, pending-verification queue,
  slip preview, approve/reject processing, public payment-status page.
- **Admin panel:** dashboard with verification queues and notifications; CRUD for
  businesses (super admin), packages, payment methods, orders, and users; delete modals.
- **Multi-tenancy:** `business_id` on orders, packages, payment methods, verifications,
  and notifications; business approval/rejection workflow.
- **Multilingual support:** `lang/en` and `lang/am` locale files, Google Translate
  integration, and a language switcher persisted per user.
- **Deployment:** Dockerfile (PHP 8.4), Nginx config, startup script
  (`start.sh`), and a Render Blueprint (`render.yaml`) with MongoDB Atlas.

### 6.4 Tools, Programming Languages and Frameworks Used
| Category | Tools / Technologies |
|----------|----------------------|
| Languages | PHP 8.3/8.4, JavaScript, HTML, CSS, Blade templates |
| Backend framework | Laravel 13.23 |
| Frontend | Tailwind CSS 4, Vite 8, glassmorphism UI (dark/light mode) |
| Database | MongoDB (local + MongoDB Atlas) |
| Auth/security | Laravel Sanctum, phone OTP 2FA, role-based middleware |
| Testing | PHPUnit (Laravel feature/unit tests), manual UAT |
| Version control | Git, GitHub |
| Deployment | Docker, Nginx, Render (Blueprint), Vercel config |

### 6.5 Approaches or Processes Followed in the Organization
- **Iterative / Agile-style development:** features delivered in short cycles
  (auth → catalog → ordering → verification → admin → deployment), with frequent
  verification against the requirements.
- **Version control workflow:** feature commits on Git; peer review through commit
  messages and branch pushes to GitHub.
- **Environment separation:** local development, containerized production, and
  environment-specific configuration (`.env`, secrets in Render dashboard).
- `[Mention the exact process used by the company, e.g., Scrum sprints, if applicable.]`

### 6.6 Examples of Problems Solved or Features Developed
- **Solved — OTP without an SMS gateway:** implemented a log-based OTP simulator
  (`SMS_DRIVER=log` / `debug_otp`) so the login-2FA flow can be tested end-to-end
  before connecting a paid gateway.
- **Solved — app crash when MongoDB is down:** made the web server boot with a
  friendly error and retry migrations on next boot.
- **Solved — uploads lost on redeploy:** documented/deployed object storage
  (S3 / Cloudflare R2) for bank slips on Render's ephemeral disk.
- **Solved — build fails without `.env`:** made `config/database.php`,
  `config/cache.php`, `config/queue.php`, and `config/session.php` fall back to
  values that boot without environment variables (composer `package:discover`).
- **Built — payment verification lifecycle:** pending → approve/reject → notify
  customer → status page, replacing manual phone-based confirmation.

---

## 7. Technical Skills and Knowledge Utilized

### Programming languages, frameworks, and tools (including testing, version control)
- PHP and the **Laravel framework** (routing, Eloquent-style ODMs, middleware,
  services, queues/cache/session drivers, Artisan CLI).
- **MongoDB** document modeling and the `mongodb/laravel-mongodb` package.
- **Frontend:** Blade, Tailwind CSS, Vite asset pipeline, responsive/glassmorphism UI.
- **Testing:** PHPUnit feature tests for auth, ordering, and verification paths.
- **Version control:** Git (branching, commits, rebase/reset, tags) and GitHub.
- **DevOps basics:** Dockerfiles, Nginx, cloud deploy (Render), environment secrets.

### Soft skills
Team communication, requirements clarification, time management across delivery
deadlines, and documentation of runnable/setup guides (README, SETUP, `admin:create`).

### Certifications or training
`[Add any certifications/trainings completed during the internship, if any.]`

---

## 8. Collaboration and Teamwork

### Experience working with the team
Worked with the assigned supervisor and (if applicable) other developers to gather
requirements, review feature behavior, and validate the payment-verification flow.
`[Describe your actual team/supervisor contact here.]`

### Collaborative tools and methodologies used
- Git/GitHub for shared code, **MVC separation of concerns** for parallel feature work.
- `[Mention tools used like project boards, Slack/Telegram, or sprint meetings.]`

### Achievements and Contributions
- Delivered the complete Payment Verification System from requirements to deployment.
- Automated the payment verification process (slip upload + admin decision) that was
  previously done manually by phone.
- Introduced OTP 2FA to protect admin and customer accounts.

---

## 9. Project Highlights

**Showcase one or two significant projects you worked on and explain the problem,
your role, and the technologies used.**

### Highlight 1 — Payment Verification Workflow
- **Problem:** customers paying by bank transfer had no accepted proof; admins confirmed
  payments manually and had no record of the evidence.
- **My role:** full-stack implementation of the verification module.
- **Technologies:** Laravel controllers/models, MongoDB, Blade views, the Flysystem
  (local/S3) upload driver.
- **Result:** customers upload a slip; admins review it in a pending queue and either
  approve or reject; the customer sees the status instantly on `/payment-status`.

### Highlight 2 — OTP Two-Factor Login
- **Problem:** administrator/customer accounts were protected only by password.
- **My role:** designed and built the OTP service and login OTP flow.
- **Technologies:** Laravel Sanctum, a dedicated `OtpService` + `PhoneVerification`
  collection, AJAX and form endpoints.
- **Challenges:** no SMS gateway in development — overcame it with a **simulated OTP**
  (logged `debug_otp` with an in-page simulation banner), which later switches to a real
  SMS driver without changing the caller code.

---

## 10. Learning and Growth

### New skills acquired during the internship
- Practical Laravel development patterns (services, middleware, config caching).
- Document-based (NoSQL) data modeling and MongoDB Atlas administration.
- Docker/Render deployment and 12-factor style environment configuration.
- Automated testing with PHPUnit and debugging via logs/tinker.

### Workshops, training, or certifications completed
`[Add any workshops/training/certifications; otherwise note self-study courses, e.g.,
official Laravel and MongoDB documentation.]`

---

## 11. Challenges Faced and Solutions

| Main difficulty encountered | How it was overcome / what was learned |
|-----------------------------|----------------------------------------|
| MongoDB driver/build compatibility in Docker (`composer install`) | Removed ext-mongodb from production requirements when not needed; made the app boot without a `.env`; used Mongo extension where available |
| Free-tier hosting limits (e.g., Render free Postgres retired) | Switched the deployment stack to **MongoDB Atlas** and to a manual Web Service with health checks |
| Ephemeral storage deletes uploaded bank slips on redeploy | Moved uploads to object storage (S3 / Cloudflare R2) |
| No real SMS gateway for OTP delivery | Implemented a log/simulation OTP driver with a hidden swap to a production driver |
| `config:cache` / `env()` pitfalls breaking production config | Enforced reading configuration via `config()` and cleared/regenerated caches during deploy |
| Windows local `php artisan serve` route issues | Started the server against the `public/` entry point (`php -S ... -t public`) |

---

## 12. Contribution to the Organization

### How your work added value
- Digitized the full order → payment → verify cycle, reducing manual/phone follow-up.
- Gave the provider a real-time admin dashboard for packages, orders, customers, payment
  methods, and verification queues.
- Provided OTP-based 2FA to raise account security.

### Deliverables, documentation, or code handed over
- Source code on GitHub (`github.com/ananchali/Intership_project`).
- `README.md`, `SETUP.md`, `PROJECT_DOCUMENTATION.md`, deploy files (`render.yaml`,
  `Dockerfile`, `nginx.conf`, `start.sh`), and a runnable local launcher
  (`php -S 127.0.0.1:8000 -t public`).
- Admin-creation helper command (`php artisan admin:create`).

---

## 13. Conclusion & Recommendations

### Summary of overall experience
The internship delivered a working, deployed **payment verification platform** for the
hosting/services domain. All core modules — authentication with OTP 2FA, package catalog,
multi-step ordering, bank-slip verification, admin panel, multi-tenancy, multilingual UI,
and cloud deployment — were implemented and tested end-to-end.

### Suggestions for improving future internship programs
- Provide a clear, written requirements brief before development begins.
- Schedule regular review/stand-up meetings with the internship supervisor.
- Give interns access to production-like staging and a test SMS/e-mail account earlier.
- `[Add your own suggestions based on your experience.]`

### How this internship will impact your future career
Strengthened confidence in delivering full-stack web systems, reinforced software
engineering best practices (design, testing, version control, deployment), and created a
portfolio artifact that demonstrates real, deployable software.

---

## 14. References

- Laravel Documentation — https://laravel.com/docs
- MongoDB & `mongodb/laravel-mongodb` docs — https://www.mongodb.com/docs
- Laravel Sanctum documentation (API tokens / auth)
- Tailwind CSS documentation — https://tailwindcss.com/docs
- Render documentation (Docker/Blueprint deployment) — https://render.com/docs
- `[Add any books, manuals, or course notes used.]`

---

## 15. Appendices (Optional)

### A. Screenshots of your work
`[Insert screenshots: home page, login/OTP page, order flow, payment-verification page,
admin dashboard, GitHub repository.]`

### B. Weekly log or attendance sheet
`[Attach the internship weekly log / attendance sheet as required by the department.]`

---

# PART TWO: IMPLEMENTATION

*Prepare a presentation slide to accompany this report, then show your project demo.*

### Presentation Slides Outline

1. **Cover page and Project Title** — Afronex Hosting — Payment Verification System
2. **Presentation Contents** — agenda of the slides
3. **Introduction** — purpose of the internship; why a payment verification platform
4. **Problem Statement**
   - Manual, phone-based confirmation of bank-transfer payments
   - No online storefront, no slip proof, no customer status tracking
   - No centralized admin dashboard for packages/orders/verifications
5. **Project Objective**
   - Online package ordering for Ethiopian hosting/service providers
   - Bank-slip upload and admin verification
   - Admin back office, OTP 2FA, multilingual, multi-business support
6. **Scope and Limitation**
   - Included: storefront, ordering, verification, admin panel, OTP, multi-tenancy, deployment
   - Excluded: real bank/telecom API integration, paid SMS/E-mail gateways, automated reconciliation
7. **Specification**
   - Laravel 13 + PHP 8.4, MongoDB Atlas, Tailwind/Vite, Sanctum + OTP
   - Modules: Auth/OTP, Catalog, Orders, Payments/Verification, Admin, Localization
8. **Project Feasibility**
   - Technical, operational, and economic feasibility of an open-source LAMP-like stack
     with Docker/Render hosting
9. **Methodology**
   - Iterative (Agile-style) development: requirements → design → implementation →
     testing → deployment; version control on GitHub
10. **Result and Outcomes**
    - Working deployed platform (demo): order → upload slip → admin approve/reject → status
    - OTP 2FA, multilingual UI, multi-business (tenant) management
11. **Conclusion and Recommendation**
    - Internship goals achieved; recommend real SMS gateway + bank-aggregator APIs
      (TeleBirr / CBE Birr / Chapa) as future work

### Project Demo
_Show a live walkthrough of the system:_
1. Home page (multi-language switch, packages).
2. Register / login with OTP simulation.
3. Place an order (multi-step checkout).
4. Upload a bank-transfer slip and submit verification.
5. Admin dashboard → pending verifications → approve/reject.
6. Customer payment-status page reflects the decision.

---

> **N. B.:** Maximum report pages — **35**. Submission date `10/01/2018 E.C.`, presentation
> date `12/01/2018 E.C.` `[update these dates if the department changes them]`