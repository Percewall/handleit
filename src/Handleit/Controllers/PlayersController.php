<?php

// file src/Controllers/ForoController.php
namespace Handleit\Controllers;
 
use Silex\Application;
use Silex\ControllerProviderInterface;
//use WowArmoryApi\BattlenetArmory;

class PlayersController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
 
        /*$controllers
            ->get('/{id}/{slug}/', array($this, 'foroShow'))
            ->bind('foro_show')
        ;*/
 
        $controllers
            ->get('/', array($this, 'playersIndex'))
            ->bind('players_index')
        ;
 
        return $controllers;
    }
 
    public function playersIndex(Application $app)
	{
		$armory = new BattlenetArmory('EU','Defias Brotherhood'); 
		return "hola";
    }
 
    /*public function foroShow(Application $app, $id, $slug)
    {
        ...
    }*/
}

