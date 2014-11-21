<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage');

$app->get('/players', function () use ($app) {
    return $app['twig']->render('players.html', array());
})
->bind('players');

$app->get('/news', function () use ($app) {
    return $app['twig']->render('news.html', array());
})
->bind('news');

$app->get('/guides', function () use ($app) {
    return $app['twig']->render('guides.html', array());
})
->bind('guides');

$app->get('/videos', function () use ($app) {
    return $app['twig']->render('videos.html', array());
})
->bind('players');

$app->get('/forums', function () use ($app) {
    return $app['twig']->render('forums.html', array());
})
->bind('forums');


$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});

