<?php

namespace phuongaz\DanhHieu;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{ CommandSender, Command, ConsoleCommandSender};
use pocketmine\event\player\{PlayerJoinEvent, PlayerInteractEvent};
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\entity\Entity;
use pocketmine\Server;
use pocketmine\item\Item;
class Loader extends PluginBase implements Listener{
	
    var $point;
	var $formapi;
	var $eco;
    var $user;
	public $prefix = "§l§c❤§d DANH HIỆU §c❤";
	
	public function onEnable(){
		
		//$this->user = new Config($this->getDataFolder(). "user.yml", Config::YAML);
		
		$this->formapi = $this->getServer()->getPluginManager()->getPlugin('FormAPI');
		$this->eco = $this->getServer()->getPluginManager()->getPlugin('EconomyAPI');
		
		$this->checkEnable($this->formapi);
		
	}
   
    public function CheckEnable($formapi) :void{
		if(is_null($formapi)){
			$this->getLogger()->warning('Không tìm thấy FormAPI cần thiết để chạy');
//$this->getPluginLoader()->disablePlugin($this);
		}else{
			$this->getLogger()->info("§l§c❤§a Plugin được lập trình bởi:§b Phuongaz");
			$this->getLogger()->info("§l§c❤§b Facebook:§f https://facebook.com/TuiLaPhuongDoNhaCacBanHiHiHiHiHiHiHiHiHiHiHi");
		}
	}
	

   public function onClick(PlayerInteractEvent $event){
	   $player = $event->getPlayer();
	   $inv = $player->getInventory();
	   $hand = $inv->getItemInHand();
	   $ar = explode(" ", $hand->getCustomName());
      if(in_array($ar[0], array('QuyVuong', 'DungSiDietQuy', 'ThieuChu', 'ChiTon', 'BaTanVlogs', 'VuaHaiTac', 'NhaVoDich', 'DanChoi'))){
		   $hand->setItemInHand(Item::BEDROCK);
		   $dhieu = $this->ListDH($ar[0]);	   
		   $perm = $this->ListPerm($ar[0]);

		   $this->getServer()->dispatchCommandMap(new ConsoleCommandSender(), 'setuperm '.$player->getName(). ' '.$perm);
		   $player->sendMessage($this->prefix.'§b Bạn vừa nhận được danh hiệu: '.$dhieu);
	   }
   }
   
   public function onQuit(pocketmine\event\player\PlayerQuitEvent $event){
	  $event->getPlayer()->setNameTag($event->getPlayer()->getName());
   }
   public function onCommand( CommandSender $player,Command $cmd, string $label, array $data):bool{
	   
	   
		   if($player instanceof Player){
			   if($cmd->getName() == "danhhieu"){
             $this->OpenForm($player);
		   
	   }elseif($cmd->getName() == "nhandanhhieu"){
		     $inv = $player->getInventory();
	   $hand = $inv->getItemInHand();
	   $ar = explode(" ", $hand->getCustomName());
      if(in_array($ar[0], array('QuyVuong', 'DungSiDietQuy', 'ThieuChu', 'ChiTon', 'BaTanVlogs', 'VuaHaiTac', 'NhaVoDich', 'DanChoi'))){
		   $inv->setItemInHand(Item::AIR);
		   $dhieu = $this->ListDH($ar[0]);	   
		   $perm = $this->ListPerm($ar[0]);

		   $this->getServer()->dispatchCommandMap(new ConsoleCommandSender(), 'setuperm '.$player->getName(). ' '.$perm);
		   $player->sendMessage($this->prefix.'§b Bạn vừa nhận được danh hiệu: '.$dhieu);
	   }else{
		   $player->sendMessage($this->prefix.'§b Bạn chưa cầm§e giấy xác nhận trên tay');
	   }
	   }
	   }
	   return true;
   }
   

   public function ListDH($dh){
	   $dhieu = [];
	   switch($dh){
	   case "ChiTon":
		   $dhieu = "§l§e✳§c CHÍ TÔN §e✳";
	  break; 
	  case "MaVuong":
		   $dhieu = "§b[§4 Ma Vương §b]";
	  break;
	  case "VuaHaiTac":
		   $dhieu = "§d[§b Vua Hải Tặc §d]";
	  break; 
	  case"DungSiDietQuy":
		   $dhieu = "§e⚔§c Dũng Sĩ Diệt Quỷ §e⚔";
	  break; 
	  case"NhaVoDich":
		   $dhieu = "§a[§5 Nhà Vô Địch §a]";
	  break; 
	  case"DanChoi":
		   $dhieu = "§e[§a Dân Chơi §e]";
	  break; 
	  case"BaTanVlogs":
		   $dhieu = "§e=§6 Bà Tân Vlogs §e=";
	  break; 
	  case"ThieuChu":
		   $dhieu = "§e♦§6 Thiếu Chủ §e♦";
	  break;
	   }
	   return $dhieu;
   }
   
   public function ListPerm($dh){
	   $perm = [];
	   switch($dh){
		   case "ChiTon":
		  $perm = "chiton.danhhieu";
		  break;
	      case "MaVuong":
		    $perm = "mavuong.danhhieu";
	      case "VuaHaiTac":
		    $perm = "vuahaitac.danhhieu";
			break;
	   case "DungSiDietQuy":
		    $perm = "dungsidietquy.danhhieu";
	  break; 
	  case "NhaVoDich";
		    $perm = "nhavodich.danhhieu";
	  break; 
	  case "DanChoi";
		    $perm = "danchoi.danhhieu";
	  break; 
	  case "BaTanVlogs";
		    $perm = "batanvlogs.danhhieu";
	  break; 
	  case "ThieuChu";
		    $perm = "thieuchu.danhhieu";
    break;
	  }
	   return $perm;
   }
	   
   public function OpenForm(Player $player){
	   $form = $this->formapi->createSimpleForm(
	      function(Player $player, $data){
			  if($data == null){
			  }
			  switch($data){
				  case 0:
				  if($player->hasPermission($this->listPerm('ChiTon'))){
				  $this->setPlayer($player, 'ChiTon');
				  $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 1:
				  if($player->hasPermission($this->listPerm('MaVuong'))){
				  $this->setPlayer($player, 'MaVuong');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 2:
				 if($player->hasPermission($this->listPerm('VuaHaiTac'))){
				  $this->setPlayer($player, 'VuaHaiTac');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 3:
				 if($player->hasPermission($this->listPerm('DungSiDietQuy'))){
				  $this->setPlayer($player, 'DungSiDietQuy');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 4:
				  if($player->hasPermission($this->listPerm('NhaVoDich'))){
				  $this->setPlayer($player, 'NhaVoDich');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 5:
				  if($player->hasPermission($this->listPerm('DanChoi'))){
				  $this->setPlayer($player, 'DanChoi');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 6:
                  if($player->hasPermission($this->listPerm('BaTanVlogs'))){
				  $this->setPlayer($player, 'BaTanVlogs');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 7:
				  if($player->hasPermission($this->listPerm('ThieuChu'))){
				  $this->setPlayer($player, 'ThieuChu');
				   $player->sendMessage($this->prefix."§b Bạn vừa mang danh Hiệu ");
				  }else{
					  $player->sendMessage($this->prefix." §bBạn không có quyền sử dụng Danh hiệu này");
				  }
				  break;
				  case 8:
				  $player->setDisplayName($player->getName());
				  $player->setNameTag($player->getName());
				  break;

			  }
		  });
		  $form->setTitle($this->prefix);
		  $form->setContent('§l§b Chọn 1 Danh Hiệu');
		  $form->addButton($this->ListDH('ChiTon'));
		  $form->addButton($this->ListDH('MaVuong'));
		   $form->addButton($this->ListDH('VuaHaiTac'));
		    $form->addButton($this->ListDH('DungSiDietQuy'));
			 $form->addButton($this->ListDH('NhaVoDich'));
			  $form->addButton($this->ListDH('DanChoi'));
			   $form->addButton($this->ListDH('BaTanVlogs'));
			    $form->addButton($this->ListDH('ThieuChu'));
				$form->addButton("§c Xóa Danh Hiệu ");
				$form->sendToPlayer($player);
   }
   
   public function setPlayer(Player $player, string $dhieu){
	   $name = $player->getName();
	   $danhhieu = $this->ListDH($dhieu);
	   
	   $player->setNameTag($danhhieu."§r§l\n".$name);
	   $player->setDisplayName($danhhieu. "§a ".$name);
   }
}
