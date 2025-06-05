# Intranet

This repository contains a Laravel application used as an internal intranet.

## Installation

1. Ensure **PHP 8.2+**, **Composer**, **Node.js** and **npm** are installed.
2. Install PHP dependencies and generate the application key:

```bash
composer install
cp .env.example .env
php artisan key:generate
```
3. Install the Breeze starter kit:

```bash
php artisan breeze:install
```
4. Install and build the front-end assets:

```bash
npm install
npm run dev
```

## Local Usage

After the steps above, start the development server:

```bash
php artisan serve
```

Visit `http://localhost:8000` to view the application. The goal of this project is to provide a simple intranet where internal users can manage orders and view dashboard statistics.

## Building for Production

Compile the assets for production with:

```bash
npm run build
```

Copy the resulting `public/build` directory to your server. Ensure that the web server's document root points to the `public/` directory.

## Testing

Run the test suite with:

```bash
composer test
```

## License

This project is open-sourced software licensed under the MIT license.
