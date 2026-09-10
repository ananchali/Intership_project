# Afronex Hosting — Payment Verification System

A Laravel (PHP 8.4) hosting/payment platform for Ethiopian businesses. Customers order
hosting/domain/services packages, pay via bank transfer, and upload payment slips for
admin verification. Data is stored in **MongoDB** (MongoDB Atlas in production).

## Stack

- **Backend**: Laravel 13, PHP ^8.3
- **Database**: MongoDB via `mongodb/laravel-mongodb`
- **Frontend**: Blade + Tailwind CSS 4 + Vite 8
- **Auth**: Laravel Sanctum + phone OTP (2FA)
- **Deploy**: Docker on Render (see `render.yaml` / `Dockerfile`)

## Local development

Requirements: PHP 8.3+ (with `mongodb` extension), Composer, Node 20.19+/22.12+, a running MongoDB.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# set MONGODB_DSN / MONGODB_DATABASE in .env

php artisan migrate --force
php artisan db:seed --force
npm run build          # or: npm run dev for hot reload
php artisan serve
```

Create the admin account:

```bash
php artisan admin:create --email=you@example.com --name="Admin" --password='<12+ char password>'
```

## Deploy to Render (production)

This repo ships a Render Blueprint (`render.yaml`) plus a `Dockerfile`. Two ways to deploy:

### Option A — Blueprint (recommended)

1. Push this repository to GitHub.
2. In the Render dashboard go to **New + → Blueprint** and select the repo.
3. Render reads `render.yaml`, creates the service, and builds the Docker image automatically.

### Option B — Docker Web Service

1. **New + → Web Service** → connect the GitHub repo.
2. **Runtime: Docker** (the `Dockerfile` is picked up automatically).
3. Add the environment variables from `render.yaml` (below) and set **Health Check Path** to `/`.

### Required environment variables

| Variable           | Value                                                                 |
|--------------------|-----------------------------------------------------------------------|
| `APP_ENV`          | `production`                                                          |
| `APP_DEBUG`        | `false`                                                               |
| `APP_KEY`          | a `base64:` key (one is already set in `render.yaml`)                 |
| `APP_URL`          | `https://<your-service>.onrender.com`                                 |
| `DB_CONNECTION`    | `mongodb`                                                             |
| `MONGODB_DSN`      | your Atlas SRV string (already in `render.yaml`)                      |
| `MONGODB_DATABASE` | e.g. `payment_verification`                                           |
| `MONGODB_USERNAME` | Atlas database user                                                   |
| `MONGODB_PASSWORD` | **Secret — set in Render Dashboard → Environment** (`sync: false`)    |
| `SESSION_DRIVER`   | `file`    (or `database`)                                             |
| `CACHE_STORE`      | `file`    (or `database`)                                             |
| `QUEUE_CONNECTION` | `sync`                                                                |
| `LOG_CHANNEL`      | `stderr`                                                              |
| `MAIL_MAILER`      | `log` (later: SMTP / Mailgun)                                          |

> `MONGODB_PASSWORD` is declared as `sync: false` in `render.yaml`, so it is **not**
> stored in code — after the first deploy, open **Dashboard → Environment** and set it
> once. The container boots even if the DB is unreachable (it shows a friendly error
> and retries migrations on the next boot).

### Create the admin after deploying

Open the Render **Shell** for your service and run:

```bash
php artisan admin:create --email=you@example.com --name=Admin --password='<12+ char password>'
# optional: --phone=0911...   (a phone triggers OTP on login)
```

Log in at `/admin/login` (select Admin role on the login page).

### File uploads (bank slips) — important

Render's **free plan uses an ephemeral disk**: uploads stored locally are deleted on
every redeploy/restart. To persist them, use object storage. The app already ships the
S3 driver (Cloudflare R2 free tier works). In Render:

- set `FILESYSTEM_DISK=s3`, and
- set `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY` (secrets), `AWS_DEFAULT_REGION=auto`,
  `AWS_BUCKET`, `AWS_ENDPOINT=https://<ACCOUNT_ID>.r2.cloudflarestorage.com`,
  `AWS_USE_PATH_STYLE_ENDPOINT=true`

### Phone OTP (2FA) — caveat

OTPs are currently **logged, not sent by SMS** (`app/Services/OtpService.php`).
With `LOG_CHANNEL=stderr` the codes appear in the Render logs (default channel), so
users/admins can retrieve them — but this is *not* secure for real production traffic.
Wire a real SMS provider (Twilio, Africa's Talking, …) before scaling up.

## Project layout

```
app/Console/Commands     artisan commands (admin:create, ...)
app/Http/Controllers     web + admin controllers
app/Http/Middleware      EnsureAdmin, EnsureSuperAdmin, SetLocale
app/Models               MongoDB models (Customer, Order, Package, ...)
app/Services             OtpService, notification services
database/migrations      MongoDB-compatible migrations
database/seeders         packages + payment methods
resources/views          Blade templates
routes/web.php           all routes
```

## Testing

The suite uses MongoDB models, so it requires a **replica set** (MongoDB Atlas or a local
`mongod --replSet`). Configure a test database in `phpunit.xml` then:

```bash
php artisan test
```

## License

MIT.