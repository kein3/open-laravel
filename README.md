# Open Laravel

This repository contains a basic Laravel application. Follow the steps below to get a local copy running and learn how to deploy it with cPanel.

## Cloning the Repository

```bash
git clone <repository-url>
cd open-laravel
```

Replace `<repository-url>` with the URL of your git repository.

## Installing Dependencies

Make sure you have PHP and [Composer](https://getcomposer.org/) installed. Then run:

```bash
composer install
```

## Setting Up Environment Variables

1. Copy the example environment file:

   ```bash
   cp .env.example .env
   ```
2. Edit `.env` and update the database credentials and any other settings you need.
3. Generate the application key:

   ```bash
   php artisan key:generate
   ```

## Running Migrations

After configuring the database in your `.env`, run the migrations:

```bash
php artisan migrate
```

## Deploying with cPanel

This project includes a `.cpanel.yml` file for automated deployments. Typical steps are:

1. On your cPanel account, create a Git Version Control repository and point it to your repo.
2. Ensure the document root of your domain or subdomain points to the `public` directory of the project.
3. After each push, cPanel will run the commands defined in `.cpanel.yml`, which include `composer install`, caching commands and migrations.
4. If automatic deployment is disabled, you can trigger it from the cPanel interface.

## Troubleshooting

- Run `php artisan config:clear` and `php artisan cache:clear` if configuration changes are not taking effect.
- Check `storage/logs/laravel.log` for error messages.
- Make sure the `storage` and `bootstrap/cache` directories are writable by the web server.
- If migrations fail during deployment, verify your database credentials and permissions.

For additional help, refer to the [Laravel documentation](https://laravel.com/docs) and your hosting provider's guides on using cPanel with Git.

