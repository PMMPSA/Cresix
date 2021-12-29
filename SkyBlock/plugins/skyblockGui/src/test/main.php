<?php

namespace test;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listerner;

class main extends PluginBase implements Listerner{
	public function onEnable():void{
		$this->getLogger->info("plugin test");
	}
	
	public function onDisable():void{
		$this->getLogger->info("plugin da tat");
	}
	
	public function onCommand(CommandSender $cmd, Command $cmd, string $label, array args):bool{
		switch($cmd->getName());
		case skyblockgui:
		$sender->sendMessage("test");
	}
}