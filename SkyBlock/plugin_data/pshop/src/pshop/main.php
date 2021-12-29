<?php

namespace pshop;

use pocketmine\{Server, Player};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Effect;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
use jojoe77777\FormAPI;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
$this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->getLogger()->info("§c✒\n\n\n§aPlugin pointshop enable\n\n\nplugin code by hera");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args):bool{
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "pshop":
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
			$this->pshop($sender);
			break;
			case 1:
			$this->muadohiem($sender);
			break;
			}					
		});					
$form->setTitle("§l§c•§6 POINTSHOP UI§c •");
				    $form->addButton("§a§ccửa hàng point");
				    $form->addButton("§a§cvật phẩm hiếm");
					
				    $form->addButton("§l§cthoát");
					$form->sendToPlayer($player);
	}
	
	public function pshop($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
case 0:

break;
case 1:
$point = $this->point->myMoney($sender);
				$cost = 5;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item1 = Item::get(466,0,32);
				$sender->getInventory()->addItem($item1);
				$sender->sendMessage("§l§amua thành công");
			}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 2:
				$point = $this->point->myMoney($sender);
				$cost = 3;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item2 = Item::get(7,0,1);
				$sender->getInventory()->addItem($item2);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
									break;
				case 3:
				$point = $this->point->myMoney($sender);
				$cost = 5;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item3 = Item::get(56,0,32);
				$sender->getInventory()->addItem($item3);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 4:
				$point = $this->point->myMoney($sender);
				$cost = 5;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item4 = Item::get(369,0,32);
				$sender->getInventory()->addItem($item4);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 5:
				$point = $this->point->myMoney($sender);
				$cost = 4;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item5 = Item::get(74,0,32);
				$sender->getInventory()->addItem($item5);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 6:
				$point = $this->point->myMoney($sender);
				$cost = 2;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item6 = Item::get(119,0,2);
				$sender->getInventory()->addItem($item6);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 7:
			$point = $this->point->myMoney($sender);
				$cost = 2;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item7 = Item::get(213,0,5);
				$sender->getInventory()->addItem($item7);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 8:
			$point = $this->point->myMoney($sender);
				$cost = 10;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item8 = Item::get(229,0,1);
				$sender->getInventory()->addItem($item8);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				case 9:
				$point = $this->point->myMoney($sender);
				$cost = 20;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
$item10 = Item::get(370,0,1);
				$sender->getInventory()->addItem($item10);
				$sender->sendMessage("§l§amua thành công");
				}else{
				$sender->sendMessage("§l§cbạn k đủ point để mua");
			return true;
			}
				break;
				}
		});
						
				   $form->setTitle("§l§c♦§6pointshop");
				    $form->addButton("§l§c->§bthoat");
					$form->addButton("§l§e•táo enchant§a|+10\n§c3 point");
					$form->addButton("§l§d•bedrock§a|+1\n§c2 point");
					$form->addButton("§l§b•ore diamond§a|+32\n§c5 point");
					$form->addButton("§l§a•Blaze Rod§a|+1\n§c2 point");
					$form->addButton("§l§•core đá đỏ§a|+32\n§c5 point");
					$form->addButton("§l§1•End Portal§a|+2\n§c4 point");
					$form->addButton("§l§2•magma block|+2\n§c2 point");
					$form->addButton("§l§5•slime Block§a|+1\n§c10 point");
					$form->addButton("§l§9•Ghast tear§a|+1\n§c20 point");
				    $form->sendToPlayer($player);
					 
	}
	
	public function muadohiem($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
	$form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
				case 0:
				$sender->sendMessage("§l§cchưa mở đâu tap vô cái lol");
				break;
				case 1:
					$sender->sendMessage("§l§cchưa mở đâu tap vô casi lol");
				break;
				case 2:
					$sender->sendMessage("§l§cchưa mở đâu tap vô cái lol");
				break;
		}
		});
 $form->setTitle("§l§c♦§6kit pointshop2§c ♦");
                   $form->addButton("§cSkit test1");
                   $form->addButton("§ckit tét2");
				    $form->addButton("§l§c->§b Trở Lại");
				    $form->sendToPlayer($player);
	}
}
