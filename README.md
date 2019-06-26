# RapportNav

Outil pour éditer des rapports de mission de contrôle, à destination des agents de la Direction des Affaires Maritimes (DAM). 
L'objectif de l'outil est de permettre la centralisation des données d'une mission de contrôle pour produire à l'ensemble des parties prenantes (environnement, sécurité maritime, gens de mers, ...) les rapports nécessaire ou exposer la base à un outil de visualisation pour le suivi d'indicateurs. 

L'application est développée avec Symfony 4, après avoir cloné le dépôt et installé les dépendances via composer il est nécessaire de configurer l'application. 
Pour ce faire, renommer le fichier d'exemple `.template.env` en `.env.local`  et y insérer les informations nécessaires (connexion à la base de données, ...). 
La documentation plus détaillée est en anglais ci-dessous. 
Le même prérequis est nécessaire pour la configuration du front : créer le fichier `assets/js/params.json` à partir du template `assets/js/template.params.json` et compléter la localisation de l'API pour les Navires et NatInf.  

## Contributions
Vous pouvez contribuer à ce code en ouvrant des issues pour indiquer des bugs. 
Pour proposer de nouvelles fonctionnalités ouvrez d'abord une issue pour échanger sur l'intérêt de son intégration dans le projet.

## Licence, Auteurs

Les contenus accessibles dans ce dépôt sont placés sous `**TODO : licence libre à valider**`. Vous êtes libre de réutiliser les contenus de ce dépôt sous les conditions précisées dans cette licence.

Les droits d'auteur sont détenus par le Ministère de la transition écologique et solidaire, Sébastien Touzé et tout contributeur dont les nom sont disponible dans l'historique des commits du dépôt. 
Pour tout contact, vous pouvez ouvrir une issue ou envoyer un mail à [sebastien.touze@developpement-durable.gouv.fr](mailto:sebastien.touze@developpement-durable.gouv.fr). 

Ce projet développé dans le cadre du programme [Entrepreneurs d'intérêt général](https://entrepreneur-interet-general.etalab.gouv.fr/) 2019. 

# RapportNav (en) 

Simple reporting tool for Direction des Affaires Maritimes (French Maritime Affairs) public officials. 

## Requirements

* PHP7.2
* composer

Other requirements are in composer.json and packages.json (for PHP and js) managed by [composer](https://getcomposer.org/) and [yarn](https://yarnpkg.com/)
To check all requirements on server use `composer check-platform-reqs` (after libraries install you may have additional platform requirements).

## Install

Install instructions are for server using Apache on Debian (Apache user being `www-data`) adapt to your needs.

A PostGre database and role should be created for the application. 

```(bash)
$ cd /var/www/
$ git clone https://github.com/SebastienTouze/rapportNav.git app/rapportNav
```
Before taking the next steps, create your environment `.env.local` file copying `.template.env`. 
You will need to configure : 
* the app setting (**APP_ENV** and **APP_SECRET**)
  * note that APP_ENV can be *prod*, *dev* or you can add other environment [see Symfony documentation for more information](https://symfony.com/doc/current/configuration.html#configuration-environments)
  * make APP_SECRET random and unique, it is used as a seed for various functionalities [see Symfony documentation for more information](https://symfony.com/doc/current/reference/configuration/framework.html#secret)
* the database access and version (**DATABASE_URL** and **DATABASE_VERSION**)

Then finish install: 

```(bash)
$ chown -R www-data:www-data app-ppr/
$ sudo -u www-data composer install
$ sudo -u www-data composer check-platform-reqs
$ sudo -u www-data yarn install
$ sudo -u www-data bin/console doctrine:migration:migrate
```

### Test environment configuration (for developers)

For tests only it is required to create a `var/data` folder where a SQLite database for tests will be instantiated. 

## Contribution 

You are welcome to contribute with tests, bug reports. 
To propose new features please open an issue first to be sure it fits the project goal.

### Coding conventions

Regarding coding style, if you use PHPStorm it should follow the coding rules in `.idea/codeStyle/codeStyleConfig.xml`. 

## Authors, licence

This code is under `**TODO**` licence. 

© Ministère de la transition écologique et Solidaire, Sébastien Touzé
© Contributors visible in repository history

