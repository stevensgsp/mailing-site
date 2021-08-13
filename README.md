# MAILING SITE

_Laravel 8.x project._

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Requirements

This is a Laravel 8.x project, so you must meet its requirements.

### Installing

Clone the project

```bash
git clone https://github.com/stevensgsp/mailing-site.git
cd mailing-site
composer install
cp .env.example .env
php artisan key:generate
```

Edit .env and put credentials, indicate environment, url and other settings.

```bash
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

Run migrations and seeders

```bash
php artisan migrate --seed
```

## Artisan command
The ```queue:mails``` artisan command will queue all email messages that are not. The ```--user``` option is optional:

```bash
php artisan queue:mails --user=<user-id>
```

## Screenshots

<img src="https://i.imgur.com/CvKjrRr.png">
<img src="https://i.imgur.com/qzI1ich.png">
<img src="https://i.imgur.com/1md8oZi.png">
<img src="https://i.imgur.com/5BifNbQ.png">
<img src="https://i.imgur.com/SITbn3Y.png">
<img src="https://i.imgur.com/Pkmp9Hm.png">
<img src="https://i.imgur.com/urGIvm9.png">
