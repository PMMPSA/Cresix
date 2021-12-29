<?php

namespace trade;

use pocketmine\{Server, Player};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use jojoe77777\FormAPI;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§c✒\n\n\n§aPlugin tradeUI enable\n\n\nplugin code by hera");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args):bool{
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "traodoi":
			$this->mainFrom($player);
			break;		
		}
		return true;
	}
	
	public function mainFrom($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
				case 0:
				
				break;
			case 1:
			$this->cuptest1($sender);
			break;
			case 2:
			$this->cuptest2($sender);
			break;
			case 3:
			$this->cuptest3($sender);
			case 4:
			$this->cuptest4($sender);
			}					
		});					
$form->setTitle("§l§c•§6 trade UI§c •");
				    $form->addButton("§l§cthoát");
				    $form->addButton("§b§lkiếm trade");
				    $form->addButton("§b§lcup thần long");
					$form->addButton("§b§lcup cường hoá");
					$form->addButton("§b§lcup hắc diện thạch");
					$form->sendToPlayer($player);
	}
	
	public function cuptest1($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:
$sender->sendMessage("§l§bcảm ơn đã ghé shop");
break;
case 1:
 if($sender->getInventory()->contains(Item::get(56,0,64))){
	 				  $sender->getInventory()->removeItem(Item::get(56,0,64));
$item1 = Item::get(276,0,1);
  $enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 10;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

    $enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 10;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

    $enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 10;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
$item1->setCustomName("kiếm trade");
				$sender->getInventory()->addItem($item1);
				$sender->sendMessage("§l§amua thành công");
				    }
						  else{
							  $sender->sendMessage("§l§cBạn không có vật phẩm để đổi");
						  }
				          return true;
						  break;
						  case 2:
						  $sender->senMessage("§l§cngon v k đổi tiếc vc");
			}
			});
			
				   $form->setTitle("§l§c♦§6tradeui");
				    $form->setContent("§l§b cần 64 ore kim cương để đổi");
				     $form->setButton1("§l§bTap lần nữa để đổi", 1);
					$form->setButton2("§l§chuỷ giao dịch", 2);
				    $form->sendToPlayer($player);
			}
	
	public function cuptest2($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
				case 1:
			  if($sender->getInventory()->contains(Item::get(370,0,3))){
								  $sender->getInventory()->removeItem(Item::get(370,0,3));
				$item1 = Item::get(257,0,1);
				$item1->setCustomName("cúp trade");
    $enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

  $enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 10;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$sender->getInventory()->addItem($item1);
							  $sender->sendMessage("§l§amua thành công");
						   }
						  else{
							  $sender->sendMessage("§l§cBạn không có vật phẩm để đổi");
						  }
				          return true;
				break;
				case 2:
				$sender->sendMessage("§l§cngon vậy không đổi tiếc vl");
						  break;
					  }
		});
		
 $form->setTitle("§l§c♦§6tradeui");
 $form->setContent("§l§b cần 3 nước mắt của con ghast");
					$form->setButton1("§l§9tap để đổi vật phẩm", 1);
					$form->setButton2("§l§9khỏi đổi nữa", 2);
				    $form->sendToPlayer($player);
	}

public function cuptest3($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:
$sender->sendMessage("§l§bcảm ơn đã ghé shop");
break;
case 1:
 if($sender->getInventory()->contains(Item::get(336,0,4))){
	 				  $sender->getInventory()->removeItem(Item::get(336,0,4));
$item1 = Item::get(278,0,1);
  $enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 200;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

    $enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
$item1->setCustomName("§l§aCúp cường hoá");
				$sender->getInventory()->addItem($item1);
				$sender->sendMessage("§l§amua thành công");
				    }
						  else{
							  $sender->sendMessage("§l§cBạn không có vật phẩm để đổi");
						  }
				          return true;
						  break;
						  case 2:
						  $sender->senMessage("§l§cngon v k đổi tiếc vc");
			}
			});
			
				   $form->setTitle("§l§c♦§6tradeui");
				    $form->setContent("§l§b cần id 336 để đổi");
				     $form->setButton1("§l§bTap lần nữa để đổi", 1);
					$form->setButton2("§l§chuỷ giao dịch", 2);
				    $form->sendToPlayer($player);
			}
			
public function cuptest4($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:
$sender->sendMessage("§l§bcảm ơn đã ghé shop");
break;
case 1:
 if($sender->getInventory()->contains(Item::get(378,0,30))){
	 				  $sender->getInventory()->removeItem(Item::get(378,0,30));
$item1 = Item::get(278,0,1);
  $enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 10;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

    $enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
$item1->setCustomName("cúp hắc diện thạch");
				$sender->getInventory()->addItem($item1);
				$sender->sendMessage("§l§amua thành công");
				    }
						  else{
							  $sender->sendMessage("§l§cBạn không có vật phẩm để đổi");
						  }
				          return true;
						  break;
						  case 2:
						  $sender->senMessage("§l§cngon v k đổi tiếc vc");
			}
			});
			
				   $form->setTitle("§l§c♦§6tradeui");
				    $form->setContent("§l§b cần 30 id item 378 để đổi");
				     $form->setButton1("§l§bTap lần nữa để đổi", 1);
					$form->setButton2("§l§chuỷ giao dịch", 2);
				    $form->sendToPlayer($player);
			}
}