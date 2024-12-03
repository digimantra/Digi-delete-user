# Laravel Custom Email Sender

![Packagist Version](https://img.shields.io/packagist/v/digimantra/appdigidelete-email)
![Packagist Downloads](https://img.shields.io/packagist/dt/digimantra/appdigidelete-email)
![GitHub License](https://img.shields.io/github/license/digimantra/appdigidelete-email?style=flat-square)

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Queueing Emails](#Queueing-Emails)
- [Composer Requirements](#Composer-Requirements)
- [License](#license)
- [Support](#support)

## Requirements

- Laravel 8, 9, or 10
- PHP 8.0 or higher

## Installation

## Configuration

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
```

### Configure the Queue

Make sure you have set up your queue configuration in `config/queue.php` and have a queue driver configured (like database, Redis, etc.). If you're using the database driver, run the migration to create the jobs table:

```bash
php artisan queue:table
php artisan migrate
```

## Usage



## Queueing Emails

To process queued jobs, execute the following command in your terminal:

```
php artisan queue:work
```

## Composer Requirements



## License

This package is released under the MIT License. Refer to the LICENSE file for details.


## Support
    For support or more details you can reach out at it@digimantra.com.