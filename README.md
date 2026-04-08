# PHP + MySQL Web Application

A full-stack PHP contact form application with MySQL persistence.

## Project Structure

```
php-app/
├── index.php          # Main form UI
├── submit.php         # AJAX form handler (POST endpoint)
├── admin.php          # Admin panel — view all submissions
├── setup.php          # One-time DB & table creator
├── includes/
│   └── db.php         # Database config & connection
└── README.md
```

## Requirements

- PHP 7.4+ (with MySQLi extension)
- MySQL 5.7+ or MariaDB 10.3+
- A local server: **XAMPP**, **WAMP**, **MAMP**, or Laravel Herd

---

## Quick Start (XAMPP Example)

### 1. Configure your database credentials

Open `includes/db.php` and update:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');      // your MySQL username
define('DB_PASS', '');          // your MySQL password
define('DB_NAME', 'php_app_db');
```

### 2. Place the project in your server root

Copy the `php-app/` folder into:
- XAMPP → `C:/xampp/htdocs/`
- WAMP  → `C:/wamp64/www/`
- MAMP  → `/Applications/MAMP/htdocs/`

### 3. Start Apache & MySQL from your control panel

### 4. Run the setup script

Visit in your browser:
```
http://localhost/php-app/setup.php
```
This creates the database and `users` table automatically.

### 5. Open the app

```
http://localhost/php-app/index.php        ← Contact Form
http://localhost/php-app/admin.php        ← View Submissions
```

---

## Database Schema

```sql
CREATE TABLE `users` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `full_name`  VARCHAR(120)  NOT NULL,
    `email`      VARCHAR(180)  NOT NULL UNIQUE,
    `phone`      VARCHAR(20)   DEFAULT NULL,
    `subject`    VARCHAR(120)  NOT NULL,
    `message`    TEXT          NOT NULL,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
);
```

---

## Security Features

- ✅ Prepared statements (prevents SQL injection)
- ✅ `htmlspecialchars()` on all user input
- ✅ `FILTER_VALIDATE_EMAIL` for email validation
- ✅ Duplicate email detection
- ✅ Server-side + client-side validation
- ✅ HTTP method enforcement (POST only on submit.php)
