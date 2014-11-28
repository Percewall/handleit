<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

    $GLOBALS['wowarmory']['db']['driver'] = 'mysql'; // Dont change. Only mysql supported so far.
    $GLOBALS['wowarmory']['db']['hostname'] = '127.0.0.1'; // Hostname of server. 
	$GLOBALS['wowarmory']['db']['dbname'] = 'wowarmory'; //Name of your database
    $GLOBALS['wowarmory']['db']['username'] = 'root'; //Insert your database username
    $GLOBALS['wowarmory']['db']['password'] = 'Xoosh4ai1haw'; //Insert your database password
    // Only use the two below if you have received API keys from Blizzard.
    $GLOBALS['wowarmory']['keys']['api'] = 'e99ngwrafq9hh52tcnwte3ytrstwjrnh'; // You need the api key from Blizzard. dev.battle.net
    $GLOBALS['wowarmory']['keys']['share'] = ''; // Currently unused
	// debug
	$GLOBALS['wowarmory']['debug']['global'] = ''; // Currently unused  

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/silex_dev.log',
));

$app->register($p = new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
));
$app->mount('/_profiler', $p);
