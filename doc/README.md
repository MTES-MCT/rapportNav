# General documentation

## Requirements

PHP7.2
PostGreSQL >=9.4 (because of use of JSONB), used 10.6 (dev, change in `config/packages/doctrine.yaml` if required)
For testes SQLite and php_sqlite are required. 

Other requirements are in composer.json and packages.json (for PHP and js) managed by [composer](https://getcomposer.org/) and [yarn](https://yarnpkg.com/)

## Install



```(bash)
$ git clone
$ composer install
$ yarn install
$ bin/console doctrine:migration:migrate
```

### Test configuration


For tests only it is required to create a `var/data` folder where the sqlite database for tests will be intanciated. 


## Conventions

Regarding coding style, if you use PHPStorm it will automatically follow the coding rules in `.idea/codeStyle/codeStyleConfig.xml`. 
