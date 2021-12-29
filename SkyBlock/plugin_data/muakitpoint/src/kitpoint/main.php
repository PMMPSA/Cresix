<?php

namespace kitpoint;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommand;
use pocketmine\command\CommandExecutor;
use jojoe77777\FormAPI;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->getLogger()->info("§c✒\n\n\n§aPlugin pointshop enable\n\n\nplugin code by hera");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args):bool{
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "muakit":
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
			$this->muakit($sender);
			break;
			case 2:
			$this->kitsextoy($sender);
			break;
			case 3:
			$this->kitdaigia($sender);
			break;
			}					
		});					
$form->setTitle("§l§c•§6 PointKitSHOP UI§c •");
				    $form->addButton("§l§cthoát");
				    $form->addButton("§a§lkit §dCresix");
					$form->addButton("§a§lkit §cSextoy");
					$form->addButton("§l§akit §dđại gia");
					$form->sendToPlayer($player);
	}
	
	public function muakit($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:

break;
case 1:
	$point = $this->point->myMoney($sender);
				$cost = 300;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);

$item1 = Item::get(276,0,1);
$item2 = Item::get(310,0,1);
				$item3 = Item::get(311,0,1);
				$item4 = Item::get(312,0,1);
				$item5 = Item::get(313,0,1);
				$item6 = Item::get(278,0,1);
				$item7 = Item::get(279,0,1);
				$item1->setCustomName("§l§akiếm §cCresix");
				$item2->setCustomName("§l§anón §aCresix");
				$item3->setCustomName("§l§agiáp §aCresix");
				$item4->setCustomName("§l§aquần §arách :||");
				$item5->setCustomName("§l§agiày §aCresix");
				$item6->setCustomName("§l§acúp Cresix");
				$item7->setCustomName("§l§abúa Cresix");
	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 250;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 20;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 20;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 100;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 40;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 60;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 100;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 40;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 60;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 40;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 60;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 100;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 40;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 60;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 30;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(18);
$level = 50;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 100;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 20;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 30;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 60;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$sender->getInventory()->addItem($item1);
						$sender->getInventory()->addItem($item2);
										$sender->getInventory()->addItem($item3);
										$sender->getInventory()->addItem($item4);
										$sender->getInventory()->addItem($item5);
										$sender->getInventory()->addItem($item6);
										$sender->getInventory()->addItem($item7);
				$sender->sendMessage("§l§amua thành công");
	}else{
	$sender->sendMessage("§cbạn k đủ point để mua");
return true;
	}
				break;
				}
		});
				   $form->setTitle("§l§c♦§6kitpoint");
				    $form->setContent("§l§b cần 300 point để đổi kit ");
					$form->setButton1("§l§a•tap de mua", 1);
					$form->setButton2("§l§e•ko mua", 2);
				    $form->sendToPlayer($player);
	}
	
	public function kitsextoy($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:

break;
case 1:
	$point = $this->point->myMoney($sender);
				$cost = 100;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);

$item1 = Item::get(352,0,1);
$item2 = Item::get(302,0,1);
				$item3 = Item::get(303,0,1);
				$item4 = Item::get(304,0,1);
				$item5 = Item::get(305,0,1);
				$item6 = Item::get(278,0,1);
				$item7 = Item::get(279,0,1);
				$item1->setCustomName("§l§cgậy sextoy");
				$item2->setCustomName("§l§anó lưới");
				$item3->setCustomName("§l§aGiap lưới");
				$item4->setCustomName("§l§aquần lưới");
				$item5->setCustomName("§l§agiày lưới");
				$item6->setCustomName("§l§dcúp của thợ sửa ống nc");
				$item7->setCustomName("§l§drìu của tokuda");
	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 150;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 10;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 20;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 50;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 40;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 60;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 50;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 40;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 30;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 520;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 20;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 30;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 50;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 20;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 30;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 30;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 20;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 50;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 10;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 20;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 10;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$sender->getInventory()->addItem($item1);
						$sender->getInventory()->addItem($item2);
										$sender->getInventory()->addItem($item3);
										$sender->getInventory()->addItem($item4);
										$sender->getInventory()->addItem($item5);
										$sender->getInventory()->addItem($item6);
										$sender->getInventory()->addItem($item7);
				$sender->sendMessage("§l§amua thành công");
	}else{
	$sender->sendMessage("§cbạn k đủ point để mua");
return true;
	}
				break;
				}
		});
				   $form->setTitle("§l§c♦§6kitpoint");
				    $form->setContent("§l§b cần 100 point để đổi kit ");
					$form->setButton1("§l§a•tap de mua", 1);
					$form->setButton2("§l§e•ko mua", 2);
				    $form->sendToPlayer($player);
	}
	
		public function kitdaigia($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:

break;
case 1:
	$point = $this->point->myMoney($sender);
				$cost = 800;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);

$item1 = Item::get(276,0,1);
$item2 = Item::get(310,0,1);
				$item3 = Item::get(311,0,1);
				$item4 = Item::get(312,0,1);
				$item5 = Item::get(313,0,1);
				$item6 = Item::get(278,0,1);
				$item7 = Item::get(279,0,1);
				$item1->setCustomName("§l§ckiếm §cđạigia");
				$item2->setCustomName("§l§anón §cđại gia");
				$item3->setCustomName("§l§agiáp §cđại gia");
				$item4->setCustomName("§l§aquần §cđại gia");
				$item5->setCustomName("§l§agiày §cđại hia");
				$item6->setCustomName("§l§dcúp §cđại gia");
				$item7->setCustomName("§l§drìu §cđại gia");
	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 150;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 300;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 100;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 10;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 20;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 50;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 100;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 80;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 100;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 100;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
	$level = 70;
	$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 100;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 100;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(0);
$level = 200;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

	$enchantment = Enchantment::getEnchantment(Enchantment::THORNS);
$level = 50;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(3);
$level = 200;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(1);
$level = 200;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 100;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(18);
$level = 500;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 100;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 100;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 50;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));

$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 200;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$sender->getInventory()->addItem($item1);
						$sender->getInventory()->addItem($item2);
										$sender->getInventory()->addItem($item3);
										$sender->getInventory()->addItem($item4);
										$sender->getInventory()->addItem($item5);
										$sender->getInventory()->addItem($item6);
										$sender->getInventory()->addItem($item7);
				$sender->sendMessage("§l§amua thành công");
	}else{
	$sender->sendMessage("§cbạn k đủ point để mua");
return true;
	}
				break;
				}
		});
				   $form->setTitle("§l§c♦§6kitpoint");
				    $form->setContent("§l§b cần 800 point để đổi kit ");
					$form->setButton1("§l§a•tap de mua", 1);
					$form->setButton2("§l§e•ko mua", 2);
				    $form->sendToPlayer($player);
	}
}

