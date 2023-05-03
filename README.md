# <span style="color: #758bfd">GSB Application Medicale Back</span>

Cette application permet la gestion médicale des clients de votre entreprise.
##  <span style="color: #3f8efc"> :rocket: Prérequis </span>

Assurez-vous d'avoir les logiciels et services suivants installés sur votre système avant de commencer :

- PHP 8.1 ou supérieur
- Composer (gestionnaire de dépendances PHP)
- Node.js 14 ou supérieur
- Yarn ou npm (gestionnaire de dépendances JavaScript)
- Symfony CLI
- Un serveur de base de données compatible (ex : MySQL, PostgreSQL)

## :star: <span style="color: #3f8efc">Installation</span>

### 1.    <span style="color: #87bfff">Clonez le dépôt git :

```git clone https://gitlab.com/gaelledndt/gsb-application-medicale-back.git``` 

```cd yourrepository```


### 2.    <span style="color: #87bfff">Installez les dépendances PHP : </span>

```composer install```


### 3.    <span style="color: #87bfff">Configurez  le fichier `.env` :</span>

```DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"```


### :star:   4.  <span style="color: #87bfff"> Créez la base de données et les tables : </span>

```php bin/console doctrine:database:create```

```php bin/console doctrine:migrations:migrate```


### 5.   <span style="color: #87bfff"> Installez les dépendances : </span>

```npm install```

```yarn install```

## <span style="color: #3f8efc"> :notebook_with_decorative_cover: Utilisation </span>

### 1. <span style="color: #87bfff">Lancer le serveur Symfony :</span>

```symfony server:start```


### 2. <span style="color: #87bfff">Lancement de React :</span>

```npm run watch```

```yarn start```

### 3. <span style="color: #87bfff">Accédez à l'application</span>

* dans votre navigateur à l'adresse http://localhost:3000
* admin :  http://localhost:3000/admin

## <span style="color: #3f8efc">:clipboard: CRUD en Symfony avec EasyAdmin</span>

###   <span style="color: #87bfff">Installer EasyAdmin : </span>

```composer require easycorp/easyadmin-bundle```


### :pushpin: <span style="color: #87bfff">Créer une nouvelle entité :

```php bin/console make:entity NomDeLEntite```

###  :pushpin:  <span style="color: #87bfff"> Migrations pour mettre à jour la base de données

#### &nbsp;&nbsp;&nbsp;&nbsp; :star: <span style="color: #7678ed">Comment générer ces migrations : </span>

```php bin/console make:migration```

 #### &nbsp;&nbsp;&nbsp;&nbsp;  :star:  <span style="color: #7678ed"> Comment appliquer ces migrations :</span>

```php bin/console doctrine:migrations:migrate```

### <span style="color: #87bfff"> Configuration EasyAdmin </span>

* ####  Configurer EasyAdmin en ajoutant des entités à gérer dans `config/packages/easy_admin.yaml` :

``` 
easy_admin:
    site_name: 'Mon Application'
    entities:
        NomDeLEntite:
            class: App\Entity\NomDeLEntite
```

#### :star:  <span style="color: #7678ed">Créer un contrôleur pour l'administration avec EasyAdmin :</span>

```php bin/console make:admin:dashboard```

####   :star:  <span style="color: #7678ed">Créer un contrôleur CRUD pour une entité avec EasyAdmin :</span>


``` php bin/console make:admin:crud NomDeLEntite```

* ####  Configurer les routes pour EasyAdmin dans config/routes.yaml :

``` 
easy_admin_bundle:
    resource: '@EasyAdminBundle/Controller/AdminController.php'
    type: annotation
```


