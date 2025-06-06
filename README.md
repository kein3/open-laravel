<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

___________________

Bien sûr, voici un **README complet**, adapté à ton projet Laravel Intranet sur Codespaces + cPanel, pensé pour un développeur débutant ou intermédiaire :

---

````markdown
# 🚀 Intranet Laravel - HoliProject

Ce projet est un intranet minimaliste, moderne et évolutif, développé sous Laravel 10, prêt à être utilisé et déployé sur Codespaces ou un hébergement cPanel.

---

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Installation & développement local (Codespaces)](#installation--développement-local-codespaces)
- [Déploiement sur cPanel](#déploiement-sur-cpanel)
- [Structure du projet](#structure-du-projet)
- [Personnalisation du design](#personnalisation-du-design)
- [Variables d'environnement `.env`](#variables-denvironnement-env)
- [Crédits](#crédits)

---

## Fonctionnalités

- **Gestion des utilisateurs** (inscription, connexion, profil)
- **Partage de fichiers** (upload, téléchargement, suppression)
- **Analyse IA (OpenAI)** : possibilité d’analyser un fichier texte (ou PDF si la librairie est installée) et d’en obtenir un résumé automatique via OpenAI Playground
- **Dashboard** dynamique : bienvenue personnalisée, accès rapide, chiffres clés, derniers fichiers
- **Design responsive et épuré** avec Tailwind CSS

---

## Installation & développement local (Codespaces)

### 1. Cloner le projet dans un Codespace GitHub

- Crée un nouveau Codespace depuis le repo GitHub [kein3/open-laravel](https://github.com/kein3/open-laravel.git).

### 2. Installer les dépendances

```bash
composer install
npm install
````

### 3. Générer le fichier `.env`

```bash
cp .env.example .env
php artisan key:generate
```

**Ajoute tes clés OpenAI, DB, etc. dans `.env`**

### 4. Utiliser SQLite pour le dev rapide (optionnel)

Dans `.env` :

```
DB_CONNECTION=sqlite
DB_DATABASE=/workspaces/open-laravel/database/database.sqlite
```

```bash
touch database/database.sqlite
```

### 5. Lancer les migrations et les assets

```bash
php artisan migrate
npx tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --minify
```

### 6. Démarrer le serveur

```bash
php artisan serve --host=0.0.0.0 --port=8001
```

> **Ouvre l’URL donnée par Codespaces (généralement [https://xxxx-xxxx-8001.app.github.dev](https://xxxx-xxxx-8001.app.github.dev)) pour accéder à l’app.**

---

## Déploiement sur cPanel

1. **Ajoute un “Git Version Control” dans cPanel**

   * Repo : `https://github.com/kein3/open-laravel.git`
   * Path : `/home/holiprojectcom/laravel`

2. **Variables d’environnement**

   * Configure la base MySQL, la clé OpenAI, l’`APP_KEY`, etc. via l’interface cPanel ou le fichier `.env` (copié à la main si besoin).

3. **Dépendances**

   * Via Terminal cPanel :

     ```bash
     composer install --optimize-autoloader --no-dev
     npm install
     npm run build
     php artisan key:generate --force
     php artisan migrate --force
     php artisan storage:link
     ```

4. **Assure-toi que le dossier public du domaine pointe sur `/laravel/public`.**

---

## Structure du projet

* `app/Http/Controllers` : Logique des fichiers, OpenAI, Dashboard, etc.
* `resources/views` :

  * `dashboard.blade.php` (Dashboard)
  * `files/` (partage de fichiers)
  * `openai/` (mini-playground IA)
  * `layouts/` (structure commune, menu…)
* `public/css/app.css` : CSS Tailwind personnalisé
* `.env` : paramètres sensibles (ne jamais commiter !)

---

## Personnalisation du design

* **Boutons noirs partout** : via la classe CSS globale ou la classe `.btn-noir`.
* **Layout** : personnalisation dans `resources/views/layouts/app.blade.php`
* **Alertes, cartes, widgets** : voir les exemples dans chaque vue.

---

## Variables d'environnement `.env`

Exemple (à adapter en prod) :

```
APP_NAME="HoliProject Intranet"
APP_ENV=production
APP_KEY=base64:xxxxxxx
APP_URL=https://ton-domaine.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=holiprojectcom_open_acme_db
DB_USERNAME=holiprojectcom_open_user
DB_PASSWORD=********

OPENAI_API_KEY=sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

---

## Crédits

* Projet initial par Kevin Vie (@kein3)
* Design et base technique : Laravel Breeze, Tailwind CSS
* API IA : [OpenAI Playground](https://platform.openai.com/playground)
* PDF parser (optionnel) : [smalot/pdfparser](https://github.com/smalot/pdfparser)

---

**Pour toute question, ouvre une issue sur le repo ou contacte le mainteneur.**

---

**Bon développement !**

```

---


