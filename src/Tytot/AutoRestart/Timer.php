<?php

namespace Tytot\AutoRestart;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class Timer extends PluginTask{
	public function __construct($plugin){
  	$this->plugin = $plugin;
  	parent::__construct($plugin);
	}
  
  public function onRun($tick){
  	$time = microtime(true) - \pocketmine\START_TIME;
		$seconds = floor($time % 60);
		$minutes = null;
		$hours = null;
		if($time >= 60){
			$minutes = floor(($time % 3600) / 60);
			if($time >= 3600){
				$hours = floor(($time % (3600 * 24)) / 3600);
			}
		}
		
		if($minutes >= 58 && $hours == 1){
     	$this->getServer()->broadcastMessage(TextFormat::RED ."PotatoCraft will restart in 30 seconds!");
      	sleep(20);
     	$this->getServer()->broadcastMessage(TextFormat::RED ."PotatoCraft is restarting in 10 seconds!");
      	sleep(9);
     	$this->getServer()->broadcastMessage(TextFormat::RED ."PotatoCraft is restarting NOW!");
      	$p->kick("PotatoCraft restarted!);
      	sleep(1);
     	$this->getServer()->shutdown();
     	return;
    }
	}
}
