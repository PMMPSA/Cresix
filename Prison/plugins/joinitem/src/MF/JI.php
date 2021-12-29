<?php

namespace MF;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\Inventory;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

Class JI extends PluginBase implements Listener{

public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
}
public function JoinItems(PlayerJoinEvent $event){
   $sender = $event->getPlayer();
   $name = $sender->getName();
      if($sender->hasPlayedBefore() == false){
   $item1 = Item::get(256, 0, 1);
   $item1->setCustomName("§l§aCúp khởi đâu\nCresixBe");
   $enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 50;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
 $item1 = Item::get(257, 0, 1);
$enchantment = Enchantment::getEnchantment(Enchantment::EFICIENCY);
$level = 30;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
   $sender->getInventory()->addItem($item1);
   $sender->sendMessage("§c=+= §aChúc các bạn chơi vui vẻ nhé ^_^§c=+=");
}
}
public function onDisable(){}
}
?>