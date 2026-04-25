# LBH Legal Aid System (Sistem Informasi Lembaga Bantuan Hukum)

A full-stack Laravel application designed for a Legal Aid Organization to manage and track legal service reports efficiently.

## Features
- **Role-based Authentication**: Admin and Staff access levels.
- **Dashboard Analytics**: Overview of report statistics, trends, and recent activities.
- **Master Data Management**: Manage Users (Admin/Staff) and Legal Service Categories.
- **Report Management**: Comprehensive CRUD operations for cases, including file attachments.
- **Advanced Filtering**: Search by name/title, and filter by status, category, date.
- **Exporting**: Generate PDF and Excel versions of reports.
- **Activity Logging**: Automatic tracking of report creation and updates.
- **RESTful API**: Basic API endpoints for integrations.

## Installation Instructions

1. **Clone/Setup Project**
   Ensure the project is placed in your web server directory (e.g., `c:\xampp\htdocs\lbh`).

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Environment Setup**
   Copy `.env.example` to `.env` (already configured in this setup for `lbh_app` database).
   ```bash
   php artisan key:generate
   ```

4. **Database Configuration**
   Ensure MySQL is running. Create a database named `lbh_app`.
   ```bash
   php artisan migrate --seed
   ```
   *Note: The seeder creates default admin (`admin@example.com` / `password`), staff (`staff@example.com` / `password`), and 12 predefined legal service categories.*

5. **Storage Link**
   To allow file attachments to be accessible publicly:
   ```bash
   php artisan storage:link
   ```

6. **Serve the Application**
   You can access the application via `http://localhost/lbh/public` if using XAMPP, or run:
   ```bash
   php artisan serve
   ```

## Default Credentials
- **Admin**: `admin@example.com` / `password`
- **Staff**: `staff@example.com` / `password`
