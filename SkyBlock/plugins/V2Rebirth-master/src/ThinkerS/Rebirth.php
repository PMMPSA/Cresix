<?php

namespace ThinkerS;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;

class Rebirth extends PluginBase implements Listener{
	
	public $tags = "§f§l[§cRebirth§f]§r ";
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		@mkdir($this->getDataFolder());
		$this->rbth = new Config($this->getDataFolder() . "players.yml", Config::YAML);
		$this->rebirth = new Config($this->getDataFolder() . "rebirths.yml", Config::YAML);
		$this->loadConfig();
		$this->saveDefaultConfig();
		$this->point =  $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->eco =  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->piclvl = $this->getServer()->getPluginManager()->getPlugin("PickaxeLevel");
	}
	public function loadConfig(){
		$this->saveResource("settings.yml");
		$this->setting = new Config($this->getDataFolder() . "settings.yml", Config::YAML);		
    }
	public function onJoin(PlayerJoinEvent $e){
		$p = $e->getPlayer()->getName();
		if(!($this->rbth->exists(strtolower($p)))){
			$this->rbth->set(strtolower($p), ["Rebirth" => 1]);
			$this->rbth->save();
			$this->rebirth->set(strtolower($p), 1);
	      	$this->rebirth->save();
			return true;
		}
		$e->getPlayer()->setDisplayName($e->getPlayer()->getName()." §e✩§aRb:§b ".$this->getRebirth($e->getPlayer())."§e✩");
	}
	public function onChat(PlayerChatEvent $ev){
		$p = $ev->getPlayer();
		$name = $p->getName();
		$p->setDisplayName("§e[§aRb:§b ".$this->getRebirth($p)."§e]§r ".$p->getName());
	}
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch($cmd->getName()){
			case "rebirth":
			if(!($sender instanceof Player)){
				$sender->sendMessage("§cDùng lệnh này trong game!");
			}else{
			$this->sendMainForm($sender);
			return true;
		}
		case "toprebirth":
		$this->topRebirth($sender);
		return true;
		}
	}
	public function topRebirth($sender){
		$toprebirth = $this->rebirth->getAll();
		$max = 0;		
        $max = count($toprebirth);
			$max = ceil(($max / 5));
			$page = array_shift($toprebirth);
			$page = max(1, $page); 
			$page = min($max, $page);
			$page = (int)$page;
			$aa = $this->rebirth->getAll();
			arsort($aa);
			$i = 1;
			foreach($aa as $b=>$a){
				if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
				$i1 = $i + 1;
				$message = "§a▶§e Hạng §b".$i."§e:§a ".$b."§b với§c ".$a."§e lần rebirth\n";
		$form = new CustomForm(function (Player $sender, ?array $data){
			$result = $data;
			if($result == null){
				}
				switch($result){
					case 0:
					break;
				}
			});
			$form->setTitle($this->setting->get("top-title")." §a".$page."§f/§a".$max);
			$form->addLabel($message);
			$form->sendToPlayer($sender);
			return $form;
				}
			}
	}
	public function sendMainForm(Player $sender){
		$form = new SimpleForm(function(Player $sender, ?int $data){
			$result = $data;
			if($result == null){
			}
			switch($result){
			case 0:
			break;
			case 1:
				$tien = $this->eco->myMoney($sender);
				$amount = $this->setting->get("rebirth-costs");
				$solan = $this->getRebirth($sender);
				$tong = $amount*$solan;
				if(!($tien >= $amount*$solan)){
					$sotienrebirth = str_replace("{sotienrebirth}", $tong, $this->setting->get("not-enough-money"));
					$sender->sendMessage($this->tags."".$sotienrebirth);//roi
				}else{
					$sender->sendMessage($this->tags."".$this->setting->get("rebirth-thanh-cong"));
					$this->eco->reduceMoney($sender, $amount);
					$currentpiclvl = $this->piclvl->getLevel($sender);
					$this->piclvl->getLevel($sender, 0);
					$this->addRebirth($sender, $this->getRebirth($sender) +1);
					break;
				}
			}
			});
			$form->setTitle($this->setting->get("form-title"));
			$solanrebirth =  str_replace("{solanrebirth}", $this->getRebirth($sender), $this->setting->get("form-content"));
			$form->setContent($solanrebirth);
			$form->addButton($this->setting->get("exit-msg"), 0);
			$form->addButton($this->setting->get("rebirth-button"), 1);
			$form->sendToPlayer($sender);
			return true;
		}
	public function getRebirth($sender){
		if($sender instanceof Player){
		$name = $sender->getName();
		$rebirth = $this->rbth->get(strtolower($name))["Rebirth"];
		return $rebirth;
		}
	}
	public function addRebirth($sender, $rebirth){
		if($sender instanceof Player){
			$name = $sender->getName();
			$this->rbth->set(strtolower($name), ["Rebirth" => $rebirth]);
			$this->rbth->save();
			$this->rebirth->set(strtolower($name), $rebirth);
			$this->rebirth->save();
		}
	}
}