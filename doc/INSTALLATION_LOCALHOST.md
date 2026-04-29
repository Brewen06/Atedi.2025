# Procedure d'installation en localhost (Windows)

Ce guide explique comment installer et lancer ATEDI en local.

## Option recommandee: Docker Compose

### 1) Prerequis

- Docker Desktop installe et demarre
- Git

### 2) Cloner le projet

```bash
git clone https://github.com/ndlaprovidence/Atedi.git
cd Atedi
git checkout 2025-2026-Symfony-7.4
```

### 3) Creer le fichier `.env.local`

A la racine du projet, creer un fichier `.env.local` puis copier/coller au minimum:

```dotenv
APP_ENV=dev
APP_SECRET=change-me

# Base de donnees MySQL utilisee par Symfony
DATABASE_URL="mysql://symfony_user:ChangeMe!@db:3306/symfony_db?serverVersion=8.0"

# Variables lues par docker-compose pour le conteneur MySQL
MYSQL_DATABASE="symfony_db"
MYSQL_USER="symfony_user"
MYSQL_PASSWORD="ChangeMe!"
MYSQL_ROOT_PASSWORD="RootChangeMe!"

# Optionnel (integration Dolibarr)
DOLIBARR_URL=http://localhost:8080/
DOLIBARR_APIKEY=change-me
TAUX_TVA=20.0
```

Important:

- Les identifiants MySQL dans `DATABASE_URL` et `MYSQL_*` doivent correspondre.
- L'hote de la base est `db` (nom du service Docker), pas `127.0.0.1`.

### 4) Construire et lancer les conteneurs

```bash
docker compose up -d --build
```

### 5) Installer les dependances PHP dans le conteneur app (si necessaire)

```bash
docker compose exec app composer install
```

### 6) Initialiser la base

```bash
docker compose exec app php bin/console doctrine:migrations:migrate -n
docker compose exec app php bin/console doctrine:fixtures:load -n
```

### 7) Vider le cache Symfony

```bash
docker compose exec app php bin/console cache:clear
```

### 8) Acceder a l'application

- Application: http://localhost:8080

Compte admin par defaut (fixtures):

- Email: admin@gmail.com
- Mot de passe: admin

---

## Option alternative: sans Docker (WAMP/XAMPP)

### 1) Prerequis

- PHP >= 8.2
- Composer
- MySQL/MariaDB (via WAMP, XAMPP, etc.)

### 2) Installer les dependances

```bash
composer install
```

### 3) Configurer `.env.local`

Exemple avec MySQL local:

```dotenv
APP_ENV=dev
APP_SECRET=change-me
DATABASE_URL="mysql://root:@127.0.0.1:3306/atedi?serverVersion=8.0"
```

### 4) Creer la base et charger les donnees

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate -n
php bin/console doctrine:fixtures:load -n
```

### 5) Lancer le serveur local

```bash
symfony server:start
```

ou

```bash
php -S localhost:8000 -t public
```

### 6) Acceder a l'application

- http://localhost:8000

---

## Depannage rapide

- Erreur de connexion SQL:
    - verifier les valeurs de `DATABASE_URL`
    - verifier que MySQL tourne
    - en Docker, verifier `docker compose ps`

- Migrations ou fixtures en erreur:

```bash
php bin/console doctrine:migrations:status
```

ou en Docker:

```bash
docker compose exec app php bin/console doctrine:migrations:status
```

- Cache Symfony corrompu:

```bash
php bin/console cache:clear
```

ou en Docker:

```bash
docker compose exec app php bin/console cache:clear
```
