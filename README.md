# Symfony Article Aggregator

## Description

Symfony Article Aggregator est une application construite avec Symfony 6.4 et PHP 8. L'objectif est de mettre en place un système d'agrégation d'articles provenant de diverses sources telles que des API externes, des flux RSS et des fichiers locaux. Ces articles sont ensuite traités et stockés dans une base de données. Une API REST est mise en œuvre pour permettre d'accéder aux articles stockés, avec des fonctionnalités CRUD.

## Fonctionnalités

- Agrégation d'articles à partir de différentes sources (API externes, flux RSS, fichiers locaux)
- Stockage des articles dans une base de données
- API REST pour accéder, créer, modifier et supprimer des articles
- Affichage simple des articles
- Authentification pour les sources de données nécessitant des credentials
- Système de cache pour limiter les requêtes répétitives
- Optimisation des performances pour gérer de grandes quantités d'articles

## Prérequis

- PHP 8.1.6 
- docker
- Composer
- Symfony CLI
- MySQL 

## Installation

1. Clonez le dépôt :
    ```bash
    git clone https://github.com/votre-utilisateur/votre-repo.git
    cd votre-repo
    ```

2. Installez les dépendances avec Composer :
    ```bash
    docker-compose exec web bash
    composer install
    ```

3. Configurez la base de données dans le fichier `.env` :
    ```env
    DATABASE_URL="mysql://mourad:mourad@localhost:3306/post_db"
    ```

4. Créez la base de données et exécutez les migrations :
    ```bash
    symfony console doctrine:database:create
    symfony console doctrine:migrations:migrate
    ```

5. Chargez les fixtures:
    ```bash
    symfony console doctrine:fixtures:load
    ```

6. Démarrez le serveur de développement :
    ```bash
    symfony server:start
    ```

## Utilisation

### Agrégation des articles



### API REST



### Affichage des articles

