<?php

// file src/Controllers/ForoController.php
namespace Handleit\Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use WowArmoryAPI\BattlenetArmory;

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
		$armory = new BattlenetArmory('EU','Cthun'); 
		$armory->setLocale('es_ES');

		// To reset back to default server locale
	    /*$armory->setLocale(FALSE);

    	// To exclude some fields from characters to load.
	    $armory->characterExcludeFields(array('achievements','quests','rank')); 
    	// To reset the exclude list to not exclude anymore
	    $armory->characterExcludeFields(FALSE); 

    	// Load all the guild data into an object. This is NOT an array 
		$guild = $armory->getGuild('Handle it');
		print_r($guild);

    	// Load all the character data into an object. This is NOT an array 
		$character = $armory->getCharacter('Percewall');
		print_r($character);*/
		// Initialize the guild object
	    $guild = $armory->getGuild('Handle it');
		
		//print_r($guild->getFeed());
    	// Adding guild rank names to all members.
	    // Supply a valid array starting with key 0. Remember to add enough ranks.
    	/*$guild_ranks = array(0=>'Guild Master',
                        1=>'Rank 1',
                        2=>'Rank 2',
                        3=>'Rank 3',
						4=>'Rank 4',
						5=>'Rank 5',
						6=>'Rank 6',
						7=>'Rank 7'
                         );
	    $guild->setGuildRankTitles($guild_ranks);
		// Get an array with all members and basic information
		$members = $guild->getMembers();*/
	    $data["members"] = $guild->getMembers('name', 'asc');
		/*$achievements = $guild->getAchievements();
		$achievements = $guild->getAchievements('timestamp','desc');
		print_r($achievements);
		$perks = $guild->getPerks();*/
		return $app['twig']->render('players.html', $data);
    }
 
    /*public function foroShow(Application $app, $id, $slug)
    {
        ...
    }*/
}

