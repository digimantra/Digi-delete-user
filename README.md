# Laravel Delete App Users

A Composer package that simplifies account deletion by providing a pre-built form to delete users via email, automating the process for developers.

![Packagist Version](https://img.shields.io/packagist/v/appdigidelete/account-deletion)  
![Packagist Downloads](https://img.shields.io/packagist/dt/appdigidelete/account-deletion)  
![GitHub License](https://img.shields.io/github/license/appdigidelete/account-deletion?style=flat-square)  

---

## Table of Contents

- [Requirements](#requirements)  
- [Installation](#installation)  
- [Configuration](#configuration)  
  - [SMTP Settings](#update-smtp-settings)  
  - [Queue Configuration](#configure-the-queue)  
- [Usage](#usage)  
- [Database Setup](#database-setup)  
- [License](#license)  
- [Support](#support)  

---

## Requirements

- **PHP** >= 8.0  
- **Laravel** 8, 9, or 10  

---

## Installation

Run the following command to install the package:  

```bash
composer require appdigidelete/account-deletion
```  

---

## Configuration  

### Database Configuration  

Ensure your database is configured correctly in your `.env` file:  

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```  

Add the following keys for user tables:  

```php
'user_table' => env('USER_TABLE', 'existing_users'),
'deleted_users_table' => env('DELETED_USERS_TABLE', 'deleted_users'),
```  

---

### Update SMTP Settings  

Modify your `.env` file to include your SMTP credentials:  

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourservice.com
MAIL_PORT=587
MAIL_USERNAME=your_email@domain.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@domain.com
```  

**Important:** Clear the configuration cache:  

```bash
php artisan config:clear
php artisan view:clear
```  

---

### Configure the Queue  

Ensure you have set up the queue configuration in `config/queue.php`. For the database driver, run the migration to create the `jobs` table:  

```bash
php artisan queue:table
php artisan migrate
```  

---

## Usage  

This package relies on the following Laravel components:  

- **illuminate/support** for Laravel framework integration  
- **illuminate/mail** for email functionality  

---

## Database Setup  

Ensure your database has the required tables:  

- **Existing Users Table**: Default `existing_users`  
- **Deleted Users Table**: Default `deleted_users`  

If the package includes migrations, publish and run them:  

```bash
php artisan migrate
```  

When a user is deleted, all their data will be transferred to the `deleted_users` table.  

---

## License  

This package is released under the MIT License. Refer to the [LICENSE](./LICENSE) file for details.  

---

## Support  

For support or more details, reach out at:  

**Email**: [it@digimantra.com](mailto:it@digimantra.com)  

---

This version improves readability, fixes formatting issues, and provides a clear structure for users to understand and implement the package.
