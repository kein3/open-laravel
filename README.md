
# 🚀 Intranet Laravel - HoliProject

Ce projet est un intranet minimaliste, moderne, sécurisé et évolutif, développé sous Laravel 10+, prêt pour le travail collaboratif et l’intégration d’outils IA.

---

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Installation & développement local (Codespaces)](#installation--développement-local-codespaces)
- [Déploiement sur cPanel](#déploiement-sur-cpanel)
- [Gestion des assets (Vite/Tailwind)](#gestion-des-assets-vitetailwind)
- [Gestion des utilisateurs](#gestion-des-utilisateurs)
- [Variables d'environnement `.env`](#variables-denvironnement-env)
- [Bonnes pratiques & maintenance](#bonnes-pratiques--maintenance)
- [Procédures courantes](#procédures-courantes)
- [Crédits](#crédits)

---

## Fonctionnalités

- **Authentification** (login uniquement : seul l’admin peut créer des comptes via Tinker ou migration)
- **Partage et gestion de fichiers** (upload, téléchargement, suppression, listing)
- **Intégration IA** (envoi de fichier à OpenAI, résumé automatisé, mini-playground)
- **Mini-dashboard dynamique** (statistiques clés, derniers fichiers, liens rapides)
- **Design responsive & minimaliste** (Tailwind CSS, Dark/Light facile à modifier)
- **Déploiement facile sur Codespaces & cPanel**
- **Sécurité par défaut** (routes protégées, maintenance, sessions sécurisées)

---

## Installation & développement local (Codespaces)

1. **Cloner le projet**

   Ouvre un Codespace sur [kein3/open-laravel](https://github.com/kein3/open-laravel.git)

2. **Dépendances**

   ```bash
   composer install
   npm install
````

3. **Configuration locale**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   * Pour tester sans base MySQL, utilise SQLite :

     ```
     DB_CONNECTION=sqlite
     DB_DATABASE=/workspaces/open-laravel/database/database.sqlite
     ```

     ```bash
     touch database/database.sqlite
     ```

   * Sinon, configure ta base comme d’habitude.

4. **Migrations**

   ```bash
   php artisan migrate
   ```

5. **Build assets**

   ```bash
   npm run dev
   ```

6. **Démarrer le serveur**

   ```bash
   php artisan serve --host=0.0.0.0 --port=8001
   ```

   Accède à l’URL Codespaces fournie.

---

## Déploiement sur cPanel

1. **Ajouter un dépôt Git sur cPanel**

   * URL du dépôt : `https://github.com/kein3/open-laravel.git`
   * Chemin du repo : `/home/holiprojectcom/laravel`

2. **Déployer la branche `main`**

   * Soit via l’interface Git de cPanel
   * Soit en SSH :

     ```bash
     cd /home/holiprojectcom/laravel
     git pull origin main
     ```

3. **Installer les dépendances**

   ```bash
   composer install --no-dev --optimize-autoloader
   npm install
   npm run build
   php artisan key:generate --force
   php artisan migrate --force
   php artisan storage:link
   ```

4. **Gérer le dossier `/public/build`**

   * Si tu ne peux pas builder côté serveur :

     * Build les assets localement ou sur Codespaces :

       ```bash
       npm run build
       cd public
       zip -r build.zip build
       ```
     * Upload puis extract `build.zip` dans `/home/holiprojectcom/laravel/public` via File Manager cPanel.

5. **Assure-toi que le DocumentRoot de ton (sous-)domaine pointe sur `/home/holiprojectcom/laravel/public`.**

---

## Gestion des assets (Vite/Tailwind)

* **Les fichiers du dossier `/public/build` ne sont pas trackés par git**
* Tu dois les builder localement (voir ci-dessus) **à chaque modification JS/CSS**
* Les autres fichiers statiques sont gérés automatiquement

---

## Gestion des utilisateurs

* **Inscription publique désactivée**
* Seul l’admin peut créer un compte :

  * Via `php artisan tinker` :

    ```php
    \App\Models\User::create([
      'name' => 'NOM',
      'email' => 'adresse@mail.com',
      'password' => bcrypt('motdepasse'),
    ]);
    ```
* La page d’accueil (`/`) redirige vers `/dashboard` (protégé par `auth`).
* Le logout redirige explicitement vers `/login`.

---

## Variables d’environnement `.env`

À copier depuis `.env.example`, puis à adapter selon l’environnement.

```dotenv
APP_NAME="HoliProject Intranet"
APP_ENV=production
APP_KEY=base64:...
APP_URL=https://open.holiproject.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=holiprojectcom_open_acme_db
DB_USERNAME=holiprojectcom_open_user
DB_PASSWORD=********

OPENAI_API_KEY=sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

**Ne jamais commit le vrai `.env` !**

---

## Bonnes pratiques & maintenance

* **Mode maintenance** :
  `php artisan down` / `php artisan up`
* **Cache** (à vider en cas de modif config) :

  ```bash
  php artisan config:clear
  php artisan config:cache
  php artisan route:clear
  php artisan view:clear
  ```
* **Vérification logs** :

  ```bash
  tail -n 30 storage/logs/laravel.log
  ```

---

## Procédures courantes

### Push/Mise à jour du code

```bash
cd /workspaces/open-laravel
git add .
git commit -m "Message"
git push origin main
git push cpanel main  # (si configuré)
```

### Mise à jour des assets

* Builder en local/Codespaces :

  ```bash
  npm run build
  cd public
  zip -r build.zip build
  ```
* Upload et extract sur le serveur

### Créer un nouvel utilisateur (admin seulement)

```bash
php artisan tinker
# puis
\App\Models\User::create([
  'name' => 'NouveauUser',
  'email' => 'email@exemple.com',
  'password' => bcrypt('motdepasse'),
]);
```

---

## Crédits

* Développé par Kevin Vie (@kein3) pour HoliProject
* Stack : Laravel Breeze, Tailwind, OpenAI API
* Icônes, styles, inspirations : [shadcn/ui](https://ui.shadcn.com/), [Laravel Breeze](https://laravel.com/docs/starter-kits)

---

**Pour toute question, ouvrez une issue GitHub ou contactez le mainteneur du repo.**

---

**Bon développement !**

```

