<h1 align="center">📊 Invoices Dashboard</h1>

<p align="center">
  A full-featured, enterprise-grade invoicing and financial management system built with the <strong>Laravel</strong> framework and styled with the <strong>Valex</strong> admin dashboard theme.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 9">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License">
</p>

---

## 📋 Table of Contents

- [About the Project](#about-the-project)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Database Schema](#database-schema)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Environment Configuration](#environment-configuration)
  - [Database Setup](#database-setup)
  - [Running the Application](#running-the-application)
- [Usage](#usage)
  - [Dashboard Overview](#dashboard-overview)
  - [Invoice Management](#invoice-management)
  - [Payment Tracking](#payment-tracking)
  - [User & Role Management](#user--role-management)
  - [Reports](#reports)
  - [Notifications](#notifications)
- [Roles & Permissions](#roles--permissions)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

---

## About the Project

**Invoices Dashboard** is a comprehensive web application for managing invoices, tracking payments, and generating financial reports. It is designed for businesses that need a centralized platform to handle the full invoice lifecycle — from creation and editing to payment collection and archiving.

The application is built on **Laravel 9** and uses the **Valex** admin theme for a polished, responsive UI. It supports multiple user roles with fine-grained permission control, real-time notifications, multi-language interfaces, and PDF invoice export.

---

## Features

### 🧾 Invoice Management
- Create, edit, view, and delete invoices
- Auto-generated unique invoice numbers
- Discount and VAT calculation
- Soft-delete with archive and recovery support
- Print / export invoices as **PDF**

### 💳 Payment Tracking
- Track payment status: **Unpaid**, **Partially Paid**, **Paid**
- Record multiple payment entries per invoice
- Remaining balance calculation per payment record

### 📁 File Attachments
- Attach files (images, PDFs) to any invoice
- Secure file storage and access control

### 📊 Analytics & Reports
- Interactive dashboard with **bar**, **pie**, **doughnut**, and **line** charts
- Invoice reports with search and filter
- Customer reports with search and filter

### 👥 User Management
- Admin-controlled user account creation
- Profile management with image upload
- User status control (active / inactive)

### 🔐 Role-Based Access Control (RBAC)
- Powered by **Spatie Laravel Permission**
- Create and assign custom roles
- Fine-grained permission checks across all modules
- Blade directive support (`@can`)

### 🔔 Real-Time Notifications
- Event-driven notifications using **Pusher**
- Mark individual or all notifications as read
- Dedicated notification display pages

### 🌐 Multi-Language Support
- Localized routes and UI via **mcamara/laravel-localization**
- Easily extensible language files

### 🔑 Authentication
- Secure session-based authentication (Laravel Breeze)
- Password reset via email
- Email verification
- Registration disabled by default (admin-only user creation)

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Framework** | Laravel 9.x |
| **Language** | PHP 8.x |
| **Database** | MySQL |
| **Authentication** | Laravel Breeze + Sanctum |
| **Authorization** | Spatie Laravel Permission |
| **PDF Generation** | barryvdh/laravel-dompdf |
| **Charts** | fx3costa/laravelchartjs (Chart.js) |
| **Real-Time** | Pusher (Laravel Broadcasting) |
| **Localization** | mcamara/laravel-localization |
| **Forms** | laravelcollective/html |
| **Frontend** | Vite, Tailwind CSS, Alpine.js, Bootstrap |
| **Testing** | PHPUnit |
| **Dev Tools** | Laravel Sail (Docker) |

---

## Database Schema

The application uses **6 core tables**:

```
users
├── id, name, email, password
├── image, status, roles_name
└── timestamps

sections
├── id, name, description
└── timestamps

products
├── id, name, description
├── section_id (FK → sections)
└── timestamps

invoices
├── id, invoice_number (unique)
├── user_id (FK → users)
├── section_id (FK → sections)
├── product_id (FK → products)
├── invoice_date, due_date
├── discount, rate_vat, value_vat
├── total, amount_collection, amount_commission
├── value_status (1=Unpaid, 2=Partial, 3=Paid)
├── remaining_amount, note
├── deleted_at (soft deletes)
└── timestamps

invoice_payments
├── id, invoice_id (FK → invoices)
├── user_id (FK → users)
├── collection_amount, payment_status
├── total, remaining_amount, note
└── timestamps

attachments
├── id, invoice_id (FK → invoices)
├── file_name (unique)
└── timestamps
```

Additional tables from **Spatie Permission**: `roles`, `permissions`, `role_has_permissions`, `model_has_roles`, `model_has_permissions`

---

## Getting Started

### Prerequisites

- **PHP** >= 8.0
- **Composer** >= 2.x
- **Node.js** >= 16.x & **npm** >= 8.x
- **MySQL** >= 5.7
- A **Pusher** account (for real-time notifications — optional)

### Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/Mohammed-Alijl/Invoices-Dashboard-By-Laravel-framework.git
   cd Invoices-Dashboard-By-Laravel-framework
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node dependencies**

   ```bash
   npm install
   ```

### Environment Configuration

1. **Copy the example environment file**

   ```bash
   cp .env.example .env
   ```

2. **Generate an application key**

   ```bash
   php artisan key:generate
   ```

3. **Configure your `.env` file** with the following values:

   ```env
   APP_NAME="Invoices Dashboard"
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=invoices
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password

   MAIL_MAILER=smtp
   MAIL_HOST=your_mail_host
   MAIL_PORT=587
   MAIL_USERNAME=your_mail_username
   MAIL_PASSWORD=your_mail_password
   MAIL_FROM_ADDRESS="no-reply@yourdomain.com"

   # Optional: Pusher for real-time notifications
   PUSHER_APP_ID=your_pusher_app_id
   PUSHER_APP_KEY=your_pusher_app_key
   PUSHER_APP_SECRET=your_pusher_app_secret
   PUSHER_APP_CLUSTER=mt1
   BROADCAST_DRIVER=pusher
   ```

### Database Setup

1. **Create the database**

   ```sql
   CREATE DATABASE invoices;
   ```

2. **Run migrations**

   ```bash
   php artisan migrate
   ```

3. **Seed the database** (roles, permissions, and a default admin user)

   ```bash
   php artisan db:seed
   ```

### Running the Application

1. **Build frontend assets**

   ```bash
   npm run build
   # or for development with hot reload:
   npm run dev
   ```

2. **Start the development server**

   ```bash
   php artisan serve
   ```

3. Open your browser and navigate to `http://localhost:8000`

---

## Usage

### Dashboard Overview

The main dashboard provides a high-level financial overview with:
- Total invoice count and value
- Invoice status breakdown (paid, unpaid, partially paid)
- User statistics (active / inactive)
- Interactive charts: bar chart (monthly invoices), pie/doughnut chart (status distribution), line chart (trends)

### Invoice Management

| Action | Description |
|--------|-------------|
| **Create Invoice** | Fill in product, section, dates, discount, VAT, and notes |
| **Edit Invoice** | Modify all invoice fields |
| **View Invoice** | Detailed view with payment history and attachments |
| **Archive Invoice** | Soft-delete for record-keeping; recoverable |
| **Restore Invoice** | Recover archived invoices from the deleted list |
| **Print Invoice** | Generate a print-ready PDF of the invoice |

**Filter invoices by status:**
- `/invoices` — All invoices
- `/invoices/paid` — Paid invoices
- `/invoices/unpaid` — Unpaid invoices
- `/invoices/Partially/paid` — Partially paid invoices
- `/invoices/archived` — Archived (soft-deleted) invoices

### Payment Tracking

Each invoice can have multiple payment records. When a payment is added:
- The invoice status is automatically updated (Unpaid → Partial → Paid)
- The remaining balance is recalculated
- A notification is triggered

### User & Role Management

- **Users**: Admins can create, edit, activate/deactivate, and delete user accounts. User creation is restricted to admin users (public registration is disabled).
- **Roles**: Create custom roles and assign specific permissions to them.
- **Permissions**: Permissions are enforced at the controller level and in Blade views using `@can` directives.

### Reports

- **Invoice Reports** (`/invoices/reports`): Search and filter invoices by date range, status, section, or product.
- **Customer Reports** (`/reports/customers`): View invoices grouped by customer/user with payment statistics.

### Notifications

- Real-time notifications are pushed via **Pusher** whenever key events occur (e.g., new payment recorded).
- Notifications are accessible via the header bell icon.
- Mark individual or all notifications as read from the notification panel.

---

## Roles & Permissions

The application uses **Spatie Laravel Permission** for RBAC. Permissions follow a consistent naming convention:

| Module | Permissions |
|--------|-------------|
| **Invoices** | `invoices-list`, `add-invoice`, `edit-invoice`, `delete-invoice`, `print-invoice`, `archive-invoice`, `recovery-invoice` |
| **Payments** | `payments-list`, `edit-payment` |
| **Attachments** | `attachments-list`, `add-attachment`, `delete-attachment` |
| **Sections** | `sections-list`, `add-section`, `edit-section`, `delete-section` |
| **Products** | `products-list`, `add-product`, `edit-product`, `delete-product` |
| **Users** | `users-list`, `add-user`, `edit-user`, `delete-user` |
| **Roles** | `roles-list`, `add-role`, `edit-role`, `delete-role` |
| **Reports** | `invoice-reports`, `customer-reports` |

Roles and permissions are seeded on first run and can be managed through the admin panel at `/roles`.

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/        # 13 controllers (Invoice, User, Role, Payment, etc.)
│   ├── Requests/           # Form request validation classes
│   └── Middleware/         # Authentication, localization, permission middleware
├── Models/                 # Eloquent models (User, Invoice, Section, Product, etc.)
├── Traits/                 # AttachmentTrait for file handling
├── Providers/              # Service providers
└── Events/                 # NewNotification event

database/
├── migrations/             # 11 migration files
├── seeders/                # Role, permission, and user seeders
└── factories/              # UserFactory

resources/
├── views/
│   ├── Front-end/          # Main application views (invoices, dashboard, reports)
│   ├── auth/               # Authentication views (login, password reset, etc.)
│   ├── components/         # Reusable Blade components
│   └── layouts/            # Master layout templates (sidebar, header, footer)
└── lang/                   # Localization language files

routes/
├── web.php                 # Authenticated web routes (localized)
├── auth.php                # Authentication routes
├── api.php                 # API routes (Sanctum)
└── channels.php            # Broadcasting channel definitions
```

---

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a Pull Request

Please make sure your code follows the existing coding style and that all tests pass before submitting a PR.

---

## License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).

---

<p align="center">Built with ❤️ using <a href="https://laravel.com">Laravel</a> & <a href="https://themeforest.net/item/valex-bootstrap-admin-dashboard-template/36458576">Valex Dashboard</a></p>
