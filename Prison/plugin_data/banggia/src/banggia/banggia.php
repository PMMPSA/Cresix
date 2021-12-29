<?php

namespace banggia;

use pocketmine\{Server, Player};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
use jojoe77777\FormAPI;

class banggia extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Code by HeralDicClaw597");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "banggia":
			$this->mainFrom($player);
			break;		
		}
		return true;
	}
	
	public function mainFrom($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $event, $data){
		$player = $event->getPlayer();
		});			
$form->setTitle("§l§a•§6 BangGia Sv§a •");
					$form->addLabel("§a♦§eVipI:§b 10 Point");
					$form->addLabel("§a♦§eVipII:§b 50 Point");
					$form->addLabel("§a♦§eVipIII:§b 100 Point");
					$form->addLabel("§a♦§eVipIV:§b 200 Point");
					$form->sendToPlayer($player);
	}
	
}	