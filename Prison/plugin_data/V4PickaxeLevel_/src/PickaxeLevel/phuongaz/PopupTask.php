<?php

namespace PickaxeLevel\phuongaz;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\Player;
use PickaxeLevel\phuongaz\Main;

Class PopupTask extends Task{


    public function __construct(Main $plugin, Player $player){

        $this->plugin = $plugin;
        $this->player = $player;
    }

    public function onRun($currentTick){
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            $level = $this->plugin->getLevel($player);
            $exp = $this->plugin->getExp($player);
            $next = $this->plugin->getNextExp($player);
            $pickaxename = $this->plugin->getNamePickaxe($player);
            $i = $player->getInventory()->getItemInHand();
            $hand = $i->getCustomName();
            $it = explode(" ", $hand);
            $damage = $i->getDamage();
            if ($it[0] == "§l§c|§b") {
                if ($damage > 30) {
                    $i->setDamage(0);
                    $player->getInventory()->setItemInHand($i);
                    $player->sendMessage("§c•§e Cúp đã được sửa chữa miễn phí ");
                }
			if($this->plugin->getLevel($player) == 10){
					if(!$i->getId() == 278){
						$item = Item::get(278,0,1)->setCustomName("$pickaxename");
						$player->getInventory()->setItemInHand($item);
						$player->sendMessage("§c•§6 Cúp đã được rèn thành cúp §bkim cương");
					}
			}
                if($this->plugin->getLevel($player) == 500) {
       $player->sendPopup("  §l§e⚡§d Pickaxe§f: §cCC §e⚡\n" . "§c❄§d EXP§g:§a " . $exp ."§l§c /§a ".$next. "§c |§a Level§f: §a" . $level);

                }elseif($this->plugin->getLevel($player) == 300){
                    $player->sendPopup("  §l§e⚡§c Pickaxe§f: §aCresix§6 VN §e⚡\n" . "§b❄§6 EXP§g:§a " . $exp ."§l§f /§a ".$next. "§c |§a Level§f: §a" . $level);

                }else{
                    $player->sendPopup("  §l§6⚡§b Pickaxe§f: §aCresix§6 VN §e⚡\n" . "§f❄§d EXP§g:§a " . $exp ."§l§c /§a ".$next. "§c |§b Level§f: §6" . $level);

                }
                         } else {
                $this->plugin->getScheduler()->cancelTask($this->getTaskId());
            }
        }
	}
}

    