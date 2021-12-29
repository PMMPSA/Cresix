<?php

namespace AmGm;

use pocketmine\utils\TextFormat as __;
use pocketmine\utils\Random;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\level\sound\AnvilUseSound;
use pocketmine\level\sound\PopSound;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\level\sound\GhastSound;
use pocketmine\level\sound\EndermanTeleportSound;
class QT1 extends PluginBase {
	public $eco;
	
	public function onEnable(){
		$this->eco = EconomyAPI::getInstance();
		$this->getLogger()->info("§b⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛\nplugin quay thưởng đã bật\n\n\n\n\nplugin edit by heraldicclaw597\n⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛");
	}
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$player->getlevel()->addSound(new ExpPickupSound($player));                                                
	}
	public function onDeath(PlayerDeathEvent $event){
		$player = $event->getPlayer();
		$player->getlevel()->addSound(new GhastSound($player));
		$player->getlevel()->addSound(new ExpPickupSound($player));
	}
	public function onQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		$player->getlevel()->addSound(new ExpPickupSound($player));
	}
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		
		if($cmd->getName() == "veso") {
			if($sender instanceof Player){
				$rand = mt_rand(1, 80);
				$sender->getLevel()->addSound(new AnvilUseSound($sender));
				if($this->eco->reduceMoney($sender->getName(), 10000)){
				switch($rand){
					case 1:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					break;
					case 18:
	$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					break;
					case 31:
	$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					break;
					case 45:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					break;
					case 50:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					break;
					case 55:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					case 65:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					case 70:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					case 75:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					case 80:
					$this->eco->reduceMoney($sender->getName(), 10000);
					$sender->sendMessage("§e•§eΔ§b Bạn đã§6 không trúng giải");
					case 85:
					$this->eco->addMoney($sender->getName(), 10000);
					$sender->sendMessage("§6•§dΔ§a Bạn đã trúng §b1.000.000VNĐ");
					$this->getServer()->broadcastMessage("§l§f⬛§b⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛§f⬛\n§r\n§aHôm nay:\n§d". $sender->getName() ."§b đã nhận§6 1.000.000VNĐ\n\n§a✔§f Giao dịch hoàn tất\n\n§a•§e Liên hệ tổng đài §bHeraldicClaw597n\n§l§f⬛§b⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛⬛§f⬛");
					break;
					default:
					$sender->sendMessage("§e•§aΔ§b Bạn đã§6 không trúng giải");
					break;
				}
				}else{
					$sender->sendMessage("§e•§eΔ§b Bạn §6cần 10.000VNĐ để mua vé số");
					return true;
				}
			}
			return True; 
		}
	}
}