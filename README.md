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

## Prérequis

- PHP 8.1.6 
- docker
- Composer
- Symfony CLI
- MySQL 

## Installation

1. Clonez le dépôt :
    ```bash
    git clone git@github.com:HammaniMourad/PostsAggregator.git
    cd PostsAggregator
    ```

3. Lancer le projet :  
   ```bash
    docker-compose up -d
    ```

4. Installez les dépendances avec Composer :
    ```bash
    docker-compose exec web bash
    composer install
    ```

5. Configurez la base de données dans le fichier `.env` :
    ```env
    docker:
    DATABASE_URL="mysql://root:root@db:3306/post_db?serverVersion=8.0.27"
    localhost
    DATABASE_URL="mysql://root:root@localhost:3306/post_db?serverVersion=8.0.

    ```

6. Créez la base de données et exécutez les migrations :
    ```bash
    symfony console doctrine:database:create
    symfony console doctrine:migrations:migrate
    ```


## Utilisation

### Agrégation des articles
 Pour accéder aux articles agrégés, utilisez l'endpoint suivant :
 GET /aggregate

## Tâches Réalisées

### Phase 1 : Agrégation d'Articles
- **Mise en place de l'interface AggregateInterface**
- **Implémentation du service SauravTech**
- **Implémentation du service Lemonde**
- **Configuration des services dans Symfony**

### Phase 2 : API REST
- **Création d'un contrôleur pour l'API REST**
- **Mise en place des routes pour accéder aux articles**

### Tâches Supplémentaires
- **Affichage simple des articles**
- **Ajout des fonctionnalités de modification, suppression et recherche des articles via l'API**
- **Prise en charge de l'authentification pour les sources de données nécessitant une authentification**
- **Intégration d'un système de cache pour limiter les requêtes répétitives**

## Temps Passé

| Tâche | Temps Passé |
|-------|--------------|
| Configuration initiale du projet | 2 heures |
| Mise en place de l'interface et des services d'agrégation | 2 heures |
| Implémentation des services SauravTech et Lemonde | 3 heures |
| Configuration du cache et des services | 1 heures |
| Création de l'API REST et du contrôleur | 3 heures |
| Ajout des fonctionnalités supplémentaires | 3 heures |
| Documentation et README | 1 heure |
| **Total** | **15 heures** |

