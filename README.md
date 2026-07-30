# Payment Verification System

A Laravel-based payment verification system similar to Yegara hosting, built with MongoDB for data storage.

## Features

- **Package Management**: Offer hosting and domain packages
- **Order Placement**: Customers can place orders with domain registration/transfer options
- **Payment Verification**: Bank slip upload and transaction reference verification
- **Admin Dashboard**: Review and approve/reject payment verifications
- **Email Notifications**: Automated notifications for order confirmation and payment status
- **Multi-bank Support**: Support for multiple Ethiopian banks

## Technology Stack

- **Backend**: Laravel 10+
- **Database**: MongoDB
- **Frontend**: Blade Templates + Tailwind CSS
- **File Storage**: Laravel File Storage
- **Authentication**: Laravel Sanctum

## Installation

### Prerequisites

- PHP 8.1+
- MongoDB
- Composer
- Node.js (for frontend assets)

### Setup Steps

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd payment-verification-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure MongoDB**
   Update your `.env` file with MongoDB settings:
   ```env
   DB_CONNECTION=mongodb
   MONGODB_DSN=mongodb://127.0.0.1:27017
   MONGODB_DATABASE=payment_verification
   # MONGODB_USERNAME=your_username
   # MONGODB_PASSWORD=your_password
   ```

5. **Create storage link**
   ```bash
   php artisan storage:link
   ```

6. **Seed database**
   ```bash
   php artisan db:seed
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

## Usage

### Customer Flow

1. **Browse Packages**: Visit homepage to view available hosting and domain packages
2. **Place Order**: Select a package and provide domain and customer information
3. **Make Payment**: Deposit to bank account using provided details
4. **Submit Verification**: Upload bank slip and enter transaction details
5. **Wait for Approval**: Admin will review and verify payment

### Admin Flow

1. **Access Dashboard**: Navigate to `/admin/dashboard`
2. **Review Pending Verifications**: Check `/admin/verifications/pending`
3. **Verify Payments**: Review bank slips and transaction details
4. **Approve/Reject**: Approve valid payments or reject with reasons

## Key Routes

### Public Routes
- `/` - Homepage (package listing)
- `/packages` - Package listing
- `/packages/{package}/order` - Order form
- `/orders/{order}` - Order details
- `/payments/create/{order}` - Payment verification form

### Admin Routes
- `/admin/dashboard` - Admin dashboard
- `/admin/verifications/pending` - Pending verifications
- `/admin/verifications/{verification}` - Review verification

## Database Schema

### Collections

#### packages
- Package information (hosting/domain)
- Pricing and features
- Active status

#### orders
- Customer orders
- Package and domain details
- Order status tracking

#### payments
- Payment information
- Transaction details
- Verification status

#### payment_verifications
- Bank slip uploads
- Verification details
- Admin notes and status

#### customers
- Customer accounts
- Contact information

## File Structure

```
payment-verification-system/
├── app/
│   ├── Models/              # MongoDB models
│   ├── Http/Controllers/     # Web controllers
│   └── Services/            # Business logic services
├── resources/views/         # Blade templates
├── database/seeders/        # Database seeders
├── public/storage/          # File uploads
└── routes/                 # Route definitions
```

## Configuration

### MongoDB Setup

1. Install MongoDB on your system
2. Create a database for the application
3. Update `.env` with connection details

### File Upload Configuration

Bank slips are stored in `storage/app/public/bank_slips/` and accessible via `public/storage/bank_slips/`.

### Email Configuration

Configure email settings in `.env` to enable email notifications:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-mail-server
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Security Considerations

- File upload validation (type, size limits)
- Input sanitization and validation
- CSRF protection on all forms
- Proper authentication and authorization
- Secure file storage and access

## Development

### Adding New Packages

Use PackageSeeder to add new packages:

```php
Package::create([
    'name' => 'New Package',
    'description' => 'Package description',
    'price' => 1000,
    'currency' => 'ETB',
    'type' => 'hosting|domain',
    'features' => ['Feature 1', 'Feature 2'],
    'is_active' => true,
]);
```

### Customizing Notifications

Modify `NotificationService` to customize email templates and sending logic.

## Testing

The system includes sample data seeding for testing purposes. Run:

```bash
php artisan db:seed
```

This will create sample packages and test data.

## License

This project is open-source and available under MIT License.
