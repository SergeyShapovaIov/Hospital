<?php

use DI\Container;
use \PDO as PDO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once dirname(__DIR__).'/vendor/autoload.php';
require_once  dirname(__DIR__).'/Config.php';

/* Отключаем предупреждения об устаревших функциях */
error_reporting(E_ALL & ~E_DEPRECATED);

if(!file_exists(dirname(__DIR__) . '/Config.php')){
  print_r("The configuration file in the root directory does not exist");
  throw new RuntimeException();
};
if(!isset($generalConfig['MYSQL_PATH'])){
  print_r("Configuration file is not set up correctly");
  throw new RuntimeException();
};

$db = new PDO($generalConfig['MYSQL_PATH'],$generalConfig['MYSQL_USER'], $generalConfig['MYSQL_PASSWORD']);

/* Используем twig*/
$loader = new FilesystemLoader ('templates');
$view = new Environment ($loader);

$container = new Container();

