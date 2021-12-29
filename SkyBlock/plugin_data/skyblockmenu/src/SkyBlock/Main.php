<?php

namespace SkyBlock;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getLogger()->Info("§bskyblcokmenu đã được bật\n\n\n\n\n\n§l§eplugin write by hera");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "menu":
			$this->hera($player);
        }
        return true;
    }
	
	public function hera($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {	
case 0:

break;			
						case 1:
							$command = "muado";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
						
						case 2:
							$command = "pshop";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
              
                        case 3:
							$command = "napthe";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
							
						case 4:
						$command = "is help";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
							
						case 5:
						$command = "shopec";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
							
						case 6:
						$command = "muarank";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
							
						case 7:
						$command = "muapoint";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
							
							case 8:
							$command = "warp pvp";
							$this->getServer()->getCommandMap()->dispatch($sender, $command);
			}
			});
			$form->setTitle("§l§b♦§aSkyBlockMenu§b♦");
			$form->addButton("§c➻❥ tap để về hub");
			$form->addButton("§a➻❥ §lmua đồ");
            $form->addButton("§d➻❥ §lpoint shop");			
            $form->addButton("§7➻❥ §lnạp thẻ");	
			$form->addButton("§9➻❥ §lAdcid help");
			$form->addButton("§e➻❥ §lec shop");
			$form->addButton("§6➻❥ §lmua rank");
			$form->addButton("§2➻❥ §lmua point");
			$form->addButton("§3➻❥ §lwarp pvp");
			$form->sendToPlayer($player);
			return true;
		}
	}
	return true;
