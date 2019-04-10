# General documentation

## Requirements

PHP7.2
php7.2-xml
php7.2-zip
php7.2-pgsql
php7.2-intl
PostGreSQL >=9.4 (because of use of JSONB), used 10.6 (dev, change in `config/packages/doctrine.yaml` if required)
For testes SQLite and php_sqlite are required. 

Other requirements are in composer.json and packages.json (for PHP and js) managed by [composer](https://getcomposer.org/) and [yarn](https://yarnpkg.com/)

## Install

Install on server uses specific user `ppr` and suppose to clone from local repository in `/var/repo/1`, adapt to your needs 
(to install on a developer computer you should only need to stat with `composet intall`). 

A PostGre database should be created with a user for the application, after the installation you may need to change the parameters in the `.env` file. 

```(bash)
$ cd /var/www/
$ git clone /var/repo/1 app/ppr
$ chown -R ppr:www-data app-ppr/
$ su ppr
$ composer install
$ yarn install
$ bin/console doctrine:migration:migrate
```

**Current project application specific note** : a `ciblage` user has been created on the server with rights on `rapportage` DB. 
`.env.local` file is addited with **prod** env and DB user/password. 


### Test environement configuration


For tests only it is required to create a `var/data` folder where the sqlite database for tests will be intanciated. 


## Conventions

Regarding coding style, if you use PHPStorm it will automatically follow the coding rules in `.idea/codeStyle/codeStyleConfig.xml`. 

## ToDos

* add instructions to import initial form data


