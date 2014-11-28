<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Doctrine\DBAL\Schema\Table;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
		'dbname' => 'wowarmory',
		'user' => 'root',
		'password' => 'Xoosh4ai1haw',
		'host' => 'localhost',
		'driver' => 'pdo_mysql',
    ),
));
$app->register(new TwigServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
}));
return $app;
