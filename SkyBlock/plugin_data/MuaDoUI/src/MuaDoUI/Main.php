<?php

namespace MuaDoUI;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {
	
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->getLogger()->info("\n\n§c•§a Đã bật MuaDoUI\n§c•§6 Code by heraldicClaw597");
    }
	
    public function onDisable() {
        $this->getLogger()->info("§cplugin bị tắt mẹ rồi");
    }
   
     
     
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
		
		switch($cmd->getName()){
		
			case "muado":			    
				if($sender instanceof Player) {					 					    
						$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
						if($api === null || $api->isDisabled()){
						
						}
					$form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
								
								case 0:
									
									break;
								case 1:
									
							      	 $money = $this->eco->myMoney($sender);
									if($money >= 100000){
										
                                       $this->eco->reduceMoney($sender, 100000);
$item1 = Item::get(267,0,1);
	$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 20;
$item1->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$item1->setCustomName("§r§l§akiếm càn quét");
				$item1->setLore(array("§r§ethanh kiếm đc phù phép bởi vị pháp sư đầy quyền năng\ntrị giá:100.000XU\n§l§c chỉ bán tại /muado\n§l§aChất lượng: §dhiếm"));
				$sender->getInventory()->addItem($item1);
								
				$sender->sendMessage("§eChúc bạn đã mua thành công thanh kiếm\n§l§etrị giá 100.000XU");
                                      return true;
                                    }else{
				  $sender->sendMessage("§c Bạn không có đủ Xu để mua vật phẩm này");
                                    }
									
									break;
								case 2:
								
								    $money = $this->eco->myMoney($sender);
									if($money >= 100000){
										
                                       $this->eco->reduceMoney($sender, 100000);
				$item2 = Item::get(257,0,1);
$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 50;
$item2->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$item2->setCustomName("§r§l§eCúp mỏ");
				$item2->setLore(array("§r§eCúp này có từ rất lâu rồi chính xác nhất là 1 ngày được tìm bởi anh cuội\n§l§etrị giá: 100.000XU\n§l§dvật phẩm: hiếm"));
				$sender->getInventory()->addItem($item2);
				$sender->sendMessage("§l§a Chúc bạn§e một ngày tốt đẹp k bị trộm cắp\n§edit em: §eItem Cúp sida\n§eGiá: §d90.000XU");
                                      return true;
                                    }else{
				  $sender->sendMessage("§c§a Bạn không có đủ§6 xu để mua vật phẩm này");
                                    }
									
									break;
								case 3:
								    
									$money = $this->eco->myMoney($sender);
									if($money >= 90000){
										
                                       $this->eco->reduceMoney($sender, 90000);
				$item3 = Item::get(258,0,1);
$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 50;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 50;
$item3->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$item3->setCustomName("§r§l§ebúa thor§e");
				$item3->setLore(array("§r§ebuá thor không phải của thor do bên server đặt cho có\n§l§etrị giá: 90.000XU\n§l§dvật phẩm: hiếm"));
				$sender->getInventory()->addItem($item3);
                                      return true;
                                    }else{
				  $sender->sendMessage("§c§a Bạn không có đủ§6 tiền§b để mua vật phẩm này");
                                    }
									
									break;
								case 4:
								    
									$money = $this->eco->myMoney($sender);
									if($money >= 90000){
										
                                       $this->eco->reduceMoney($sender, 90000);
				$item4 = Item::get(256,0,1);
		$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
$level = 50;
$item4->addEnchantment(new EnchantmentInstance($enchantment, $level));
				$item4->setCustomName("§r§l§eSẻng vip§e");
				$item4->setLore(array("§r§eVật phẩm test"));
				$sender->getInventory()->addItem($item4);
                                      return true;
                                    }else{
				  $sender->sendMessage("§c§a Bạn không có đủ§6 tiền§b để mua vật phẩm này");
                                    }
                                    break;
				  case 5:
				  	$money = $this->eco->myMoney($sender);
					if($money >= 200000){
				$this->eco->reduceMoney($sender, 200000);
			$item5 = Item::get(267,0,1);
$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 10;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));
$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 200;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));
$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 500;
$item5->addEnchantment(new EnchantmentInstance($enchantment, $level));
			$item5->setCustomName("§r§e§akiếm §l§aCresixPe");
			$item5->setLore(array("Vật phẩm được tìm thấy bởi nhà bác học HeralDicClaw597\n§l§etrị giá:200.000XU\n§l§cvât phẩm:cực hiếm"));
            $sender->getInventory()->addItem($item5);
            $sender->sendMessage("§a§c Bạn đã mua vật phẩm");
				
            return true;
            }else{
              				  $sender->sendMessage("§l§a Bạn không có đủ§6 tiền§b để mua vật phẩm này");
              				  }
					break;
		case 6:
						  	$money = $this->eco->myMoney($sender);
					if($money >= 10000000){
             $this->eco->reduceMoney($sender, 10000000);
             $item6 = Item::get(349,5,1);
             $item6->setCustomName("§r§ecá thần");
             $item6->setLore(array("§r§l§r§bLoài sắp tuyệt chủng chỉ có thể bắt nó ở sông amazon\n§l§e giá trị của con cá lên đến:1.000.000XU\n§l§cvật phẩm hiếm hơn mấy cái nhìu"));
         $enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 700;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));
$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 100;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));
$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 100;
$item6->addEnchantment(new EnchantmentInstance($enchantment, $level));
             $sender->getInventory()->addItem($item6);
             $sender->setMaxHealth(120);
             $sender->setHealth(120);
		$sender->sendMessage("§l§abạn đã mua vật phẩm thành công");	
		            return true;
            }else{
              				  $sender->sendMessage("§l§a Bạn không có đủ§6 tiền§b để mua vật phẩm này");
              				  }
					break;
			  case 7:
				  	$money = $this->eco->myMoney($sender);
					if($money >= 8000000){
				$this->eco->reduceMoney($sender, 8000000);
			$item7 = Item::get(369,0,1);
$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
$level = 40;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));
$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
$level = 30;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));
$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
$level = 0;
$item7->addEnchantment(new EnchantmentInstance($enchantment, $level));
			$item7->setCustomName("§r§e§cgậy sextoy");
			$item7->setLore(array("Vật phẩm được tìm thấy từ nhà bị cáo dinhngocduy\n§l§etrị giá:8.000.000.000XU\n§l§cvât phẩm:hơi hiếm\n§l§edã qua sử dụng\n§d…do owner DinhNgocDuy thủ dâm quá nhìu"));
            $sender->getInventory()->addItem($item7);
            $sender->sendMessage("§a§c Bạn đã mua vật phẩm");
            }else{
              				  $sender->sendMessage("§l§a Bạn không có đủ§6 tiền§b để mua vật phẩm này");
              				  }
break;
							}
					
						});
						
					$form->setTitle("§l§eMUADOUI List");
$form->addButton("§l§eEXIT");
				    $form->addButton("§l§akiếm càn quét\ngiá:100.000XU");
				    $form->addButton("§r§l§ecúp Mỏ\ngiá:100.000XU");
				    $form->addButton("§r§l§cbúa thor\ngiá:90.000XU");
				    $form->addButton("§r§l§dsẻng của thợ hồ\ngiá:90.000XU");
	$form->addButton("§l§bkiếm Cresix\ngá:200.000XU");
		$form->addButton("§r§2cá thần\ngiá:10.000.000XU");
		$form->addButton("§l§dgậy sextoy\ngía: 8.000.000XU");
					$form->sendToPlayer($sender);
				}
				else{
					$sender->sendMessage("lỗi con mẹ nó rồi");
					return true;
				}
			break;
		}
		return true;
    }
	
	
	
}