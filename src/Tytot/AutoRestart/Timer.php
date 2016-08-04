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
		}
		if($time >= 3600){
			$hours = floor(($time % (3600 * 24)) / 3600);
		}
		if($minutes >= 58 && $hours == 1){
			$this->plugin->seconds -= 1;
			if($this->plugin->seconds > 1){
				foreach($this->plugin->getServer()->getPlayers() as $p){
					$p->sendMessage(TextFormat::RED ."PotatoCraft restarts in ".$this->plugin->seconds." seconds!");
				}
			}elseif($this->plugin->seconds == 1){
				foreach($this->plugin->getServer()->getPlayers() as $p){
					$p->sendMessage(TextFormat::RED ."PotatoCraft is restarting now!");
				}
			}elseif($this->plugin->seconds == 0){
				$this->getServer()->shutdown();
				return;
			}
		}
	}
}
