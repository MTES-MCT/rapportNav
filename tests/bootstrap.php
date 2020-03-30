<?php

use Symfony\Component\Dotenv\Dotenv;
use Doctrine\Common\Annotations\AnnotationReader;

require dirname(__DIR__).'/vendor/autoload.php';

AnnotationReader::addGlobalIgnoredName('group');
AnnotationReader::addGlobalIgnoredName('depends');
AnnotationReader::addGlobalIgnoredName('dataProvider');


if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}
