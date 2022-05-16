## Packt> Technical Task

Requirements

PHP >= 8.0

Composer >= 2.0

## Installation

After cloning the git repo, please change/add the following variables in .env file:

```sh
DB_DATABASE = {YOUR_DATABASE_NAME}
DB_USERNAME = {YOUR_DATABASE_USER}
DB_PASSWORD = {YOUR_DATABASE_PASSWORD}
REST_API_URL = "https://gorest.co.in/public/v2/"
REST_API_TOKEN = {GOREST_API_TOKEN}
```

Run the following commands in the terminal to install the dependencies and modules:

```sh
composer install
```

```sh
npm install && npm run dev
```

Run the following command to add database tables:

```sh
php artisan migrate
```

Run the following command to prepopulate database table values:

```sh
php artisan db:seed
```

Run the following command to start the application:

```sh
php artisan serve
```

Open http:127.0.0.1:8000 in browser to run the application.

During seeding, a demo admin account has been created with following details:
user: pankaj89@ymail.com
pass: packt2003
