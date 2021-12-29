<?php

namespace gmgs;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Event;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use _64FF00\PureChat\PureChat;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\{Player, Server};
use pocketmine\utils\Config;

class AdaSeviye extends PluginBase implements Listener{
	
	public $cfg;
	public $config;
	public $level;
	public $exp;
	public $saxp;
	
	public function onEnable(){
		@mkdir($this->getDataFolder());		
		$this->saxp = new Config($this->getDataFolder() . "SeviyeAtlamaXp.yml", Config::YAML);
	$this->exp = new Config($this->getDataFolder() . "Exp.yml", Config::YAML);
$this->level = new Config($this->getDataFolder() . "Seviyeler.yml", Config::YAML);
  $this->cfg = new Config($this->getDataFolder() . "AdaLevel.yml", Config::YAML,[
             "Seviyen" => "§cSeviyen: §7",
             "MevcutXp" => "§cMevcut XP: §7",
             "seviyeatla" => "§cSeviye Atlandı!",
             "seviyeatla2" => "§cAtlanılan Seviye §7",
             "seviyeatla3" => "§cMevcut XP: §7"
        ]);
   $this->PureChat = $this->getServer()->getPluginManager()->getPlugin("PureChat");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("Seviye đã hoạt động..!");
	}
	
	public function onCommand(CommandSender $sender, Command $kmt, string $label, array $args): bool{
		$user = $sender->getPlayer()->getName();
		$user2 = $sender->getPlayer();
		if($kmt->getName() == "leveldao"){
			$this->seviyeForm($sender);
		}
		
		if($kmt->getName() == "topdao"){
  $max = 0;
				 $c = $this->level->getAll();			
            $max = count($c);
				$max = ceil(($max / 5));
				$page = array_shift($args);
				$page = max(1, $page);
				$page = min($max, $page);
				$page = (int)$page;
				$sender->sendMessage("§cCấp đảo cao nhất §d".$page."§b/§a".$max);
				$aa = $this->level->getAll();
				arsort($aa);
				$i = 0;
				foreach($aa as $b=>$a){
				if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
				$i1 = $i + 1;
				$sender->sendMessage(" §8[§a".$i1."§8] §7".$b." §8» §7".$a);
				}
				$i++;
				}
				}
 	return true;
 }
	
	public function blockKoymaEvent(BlockPlaceEvent $e){
		$user = $e->getPlayer()->getName();
		$user2 = $e->getPlayer();	
	$block = $e->getBlock();
	$oyuncu = $e->getPlayer();
	$isim = $e->getPlayer()->getName();
		if($this->exp->get($user) < $this->saxp->get($user)){
$this->exp->set($user, $this->exp->get($user) +0.3);
     } else {
               $this->exp->set($user, 0);
               $this->level->set($user,$this->level->get($user) +1);
               $this->PureChat->setPrefix($this->level->get($user), $e->getPlayer());
   $this->saxp->set($user, $this->saxp->get($user) + 50);
 $user2->addTitle($this->cfg->get("seviyeatla"), $this->cfg->get("seviyeatla2") . $this->level->get($user)."\n".$this->cfg->get("seviyeatla3").$this->exp->get($user));
         $this->saxp->save();
        $this->level->save();
       $this->exp->save();
           }
       }
       
  public function oG(PlayerJoinEvent $event){
      	$user = $event->getPlayer()->getName();
      	if($this->saxp->get($user) > 0){
        } else {
            $this->saxp->set($user, 150);
            $this->level->set($user, 1);
            $this->exp->set($user, 1);
            	}
            	 $this->PureChat->setPrefix($this->level->get($user), $event->getPlayer());
            	 }
            	 
	public function seviyeForm(Player $sender){
		$f = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $dender, $data){
			$re = $data[0];
			if($re === null){
				return true;
			}
			switch($re){
				case 0:
				break;
			}
		});
		$f->setTitle("§l§aThông tin cấp độ");
		$f->setContent("§8» §bTên người dùng§7: ".$sender->getName()."\n§8» §dSeviyen§7: ".$this->level->get($sender->getName())."\n§8» §dXP có sẵn§7: ".$this->exp->get($sender->getName()));
		$f->addButton("§ctắt");
		$f->sendToPlayer($sender);
	}
}