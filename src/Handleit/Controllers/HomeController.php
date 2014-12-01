<?php

// file src/Controllers/ForoController.php
namespace Handleit\Controllers;
 
use Silex\Application;
use Silex\ControllerProviderInterface;
use WowArmoryAPI\BattlenetArmory;
use feedReader\feedReader;

class HomeController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
 
        /*$controllers
            ->get('/{id}/{slug}/', array($this, 'foroShow'))
            ->bind('foro_show')
        ;*/
 
        $controllers
            ->get('/', array($this, 'homeIndex'))
            ->bind('home')
        ;
 
        return $controllers;
    }
 
    public function homeIndex(Application $app)
	{
		#$sql="select post_username, post_subject, post_text from phpbb_handleitposts where post_approved=1 order by post_time desc limit 1";
		/*$sql="select * from phpbb_handleittopics limit 1";
		$data['users'] = $app['db']->fetchAll($sql);
		print_r($data);*/
		$feed = new feedReader();
		//$data['news'] = $feed->getMmoChampion();
		$data['news'] = $feed->getBlizzard();
		print_r($data ['news']);
		die;
		return $app['twig']->render('home.html', $data);
    }
 
    /*public function foroShow(Application $app, $id, $slug)
    {
        ...
    }*/
}

