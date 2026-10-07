# BiblioConnect

BiblioConnect est une application Symfony de gestion de bibliothèque. Elle permet de gérer les livres, auteurs, catégories, langues, réservations, favoris, commentaires et comptes utilisateurs selon les rôles administrateur, bibliothécaire et utilisateur.

## Stack technique

- PHP 8.4
- Symfony 8
- Doctrine ORM
- PostgreSQL
- Twig
- PHPUnit
- Docker Compose (base de données)

## Prérequis

Avant de lancer le projet, assurez-vous d'avoir installé :

- PHP 8.4+
- Composer
- Symfony CLI (optionnel mais recommandé)
- PostgreSQL ou Docker

## Installation

1. Clonez le projet :

```bash
git clone <url-du-projet>
cd BiblioConnect
```

2. Installez les dépendances PHP :

```bash
composer install
```

3. Configurez la base de données dans le fichier `.env` si nécessaire.

Par défaut, le projet utilise une base PostgreSQL définie dans `.env`.

## Démarrage de la base de données

Si vous souhaitez utiliser Docker pour PostgreSQL :

```bash
docker compose up -d database
```

## Lancement de l'application

### Avec Symfony CLI

```bash
symfony serve
```

### Ou directement via PHP

```bash
php -S localhost:8000 -t public
```

Puis ouvrez :

```text
http://localhost:8000
```

## Migrations et fixtures

Créez ou mettez à jour la base de données :

```bash
php bin/console doctrine:migrations:migrate
```

Pour charger les données de test/fixtures :

```bash
php bin/console doctrine:fixtures:load
```

## Tests

Lancez les tests PHPUnit :

```bash
php bin/phpunit
```

## Structure principale

- `src/Controller` : contrôleurs MVC
- `src/Entity` : entités Doctrine
- `src/Form` : formulaires Symfony
- `src/Repository` : repositories
- `templates/` : vues Twig
- `config/` : configuration Symfony
- `migrations/` : migrations Doctrine
- `tests/` : tests

## Développement

Pour nettoyer le cache Symfony :

```bash
php bin/console cache:clear
```

Pour vérifier les routes de l'application :

```bash
php bin/console debug:router
```

## Notes

Le fichier `.env` contient les variables d'environnement du projet. Ne stockez jamais de secrets sensibles dans un dépôt public.

## License

Ce projet est fourni sans licence spécifique dans le dépôt courant.
