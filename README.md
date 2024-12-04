# Laravel Delete app users

A Composer package that simplifies account deletion by providing a pre-built form to delete users via email, automating the entire process for developers

 
![Packagist Version](https://img.shields.io/packagist/v/appdigidelete/account-deletion)
![Packagist Downloads](https://img.shields.io/packagist/dt/appdigidelete/account-deletion)
![GitHub License](https://img.shields.io/github/license/appdigidelete/account-deletion?style=flat-square)

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Composer Requirements](#Composer-Requirements)
- [License](#license)
- [Support](#support)

## Requirements

-PHP >= 8.0
-Laravel 8, 9, or 10

## Installation

-composer require appdigidelete/account-deletion

## Configuration
-Ensure Your Databse Has been configured properly check your ".env" file.

-'user_table' => env('USER_TABLE', 'existing_users'),
'deleted_users_table' => env('DELETED_USERS_TABLE', 'deleted_users'),

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

**Important:** Clear the configuration cache with:

```bash
php artisan config:clear
php artisan view:clear
```

### Configure the Queue

Make sure you have set up your Config configuration in `config/config.php`configured (like database, Redis, etc.). If you're using the database driver, run the migration to create the jobs table:

```bash
php artisan queue:table
php artisan migrate
```

## Usage
-Additional Dependencies: This package may rely on the following Laravel components:

illuminate/support for Laravel framework integration.
illuminate/mail for email functionality.

## Composer Requirements
-Set Up Database Tables: Ensure your database has the required tables:

Existing users table (default: existing_users)
Deleted users table (default: deleted_users)
If the package includes migrations, publish and run them.
Further If the user is Deleted all, its data will be shift to Deleted_users

## License

-This package is released under the MIT License. Refer to the LICENSE file for details.


## Support
-For support or more details you can reach out at it@digimantra.com.
