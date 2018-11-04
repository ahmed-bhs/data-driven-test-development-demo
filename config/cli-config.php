<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__.'/../');
$dotenv->load();

$paths = [__DIR__.'/../src/Entity'];
$isDevMode = true;

$dbParams = [
    'host'     => getenv('DB_HOST'),
    'driver'   => getenv('DB_DRIVER'),
    'user'     => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'dbname'   => getenv('DB_DATABASE'),
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$em = \Doctrine\ORM\EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($em);
