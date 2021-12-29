<?php

/** -----[BankUI]-----
* Register & Save Data To Config
* Bank (Old Version)
* Reform Main with UI System
* Old Version: https://github.com/d2pdev/Bank_VI/tree/master/Bank
*/

namespace BlackPMFury\BankUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\{Player, Server};
use pocketmine\utils\Config;
use onebone\economyapi\EconomyAPI;
use jojoe7777\FormAPI;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
	public $tag = "§a>§c•§a< §aBankUI §a>§c•§a<";
	
	public function onEnable(){
		$this->getServer()->getLogger()->info($this->tag . "§a Enable Plugin");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!is_dir($this->getDataFolder())){
			mkdir($this->getDataFolder());
		}
		$this->nganhang = new Config($this->getDataFolder() ."nganhang.yml", Config::YAML, []);
		$this->EconomyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->eco = EconomyAPI::getInstance();
	}
	
	public function taoNguoiDung($ten){
		$ten = strtolower($ten);
		$this->nganhang->set($ten, 0);
		$this->nganhang->save();
	}
	
	public function congTien($ten, $tien){
		$ten = strtolower($ten);
		$tienhienco = $this->nganhang->get($ten);
		$this->nganhang->set($ten, $tienhienco + $tien);
		$this->nganhang->save();
	}
	
	public function truTien($ten, $tien){
		$ten = strtolower($ten);
		$this->congTien($ten, -$tien);
	}
	
	public function caiTien($ten){
		$ten = strtolower($ten);
		$this->nganhang($ten, $tien);
		$this->nganhang->save();
	}
	
	public function xemTien($ten){
    $ten = strtolower($ten);
	if($this->kiemTra($ten)){
		$tienhienco = $this->nganhang->get($ten);
		return $tienhienco;
	}
	return false;
	}
	
	public function kiemTra($ten){
		$ten = strtolower($ten);
		if($this->nganhang->exists($ten)){
			return true;
		}
		return false;
	}
	
	public function onJoin(PlayerJoinEvent $ev){
		$player = $ev->getPlayer();
		$ten = $player->getName();
		$tienhienco = $this->xemTien($ten);
		$msg = "
§a-==<§c•§a> §eTài Khoản Của Bạn <§c•§a>==-
§aTài Khoản Dư:§e $tienhienco
§cLưu Ý: Cứ 1 h Sẽ Dc paycheck (Tính Năng Đang Bảo trì)
";
		foreach($this->getServer()->getOnlinePlayers() as $players){
			$players->sendMessage($msg);
			$this->taoNguoiDung($ten);
		}
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch(strtolower($cmd->getName())){
			case "bank":
			if(!$sender instanceof Player){
				$this->getServer()->getLogger()->warning($this->tag . " §ePlease use command in Game!");
				return true;
			}
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null) {
				}
				switch($result){
					case 0:
					$this->addMoney($sender);
					break;
					case 1:
					$this->reduceMoney($sender);
					break;
					case 2:
					$this->checkMoney($sender);
					break;
					case 3:
					$this->chuyenTien($sender);
					break;
				}
			});
			$form->setTitle($this->tag);
			$form->setContent("§a Đây Là nơi Giúp Bạn Tiết kiệm tiền & Kinh tế cho bạn!");
			$form->addButton("§c>§d•§c< §aGửi Tiền §c>§d•§c<", 0);
			$form->addButton("§c>§d•§c< §aRút Tiền §c>§d•§c<", 1);
			$form->addButton("§c>§d•§c< §aXem Tiền §c>§d•§c<", 2);
			$form->addButton("§c>§d•§c< §aChuyển Tiền §c>§d•§c<", 3);
			$form->sendToPlayer($sender);
		}
		return true;
	}
	
	public function addMoney($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			$ten = strtolower($sender->getName());
			$tien = $data[1];
			$tien = round($tien, 3);
			$money = $this->EconomyAPI->myMoney($sender->getName());
			if($money >= $tien){
				$this->congTien($ten, $tien);
				$this->eco->reduceMoney($ten, $tien);
				foreach($this->getServer()->getOnlinePlayers() as $players){
					$players->sendPopup($this->tag . "§fBạn đã gửi §a$tien §fvào ngân hàng !");
				}
				if($tien >= 2000000){
					$this->getServer()->broadcastMessage($this->tag . "§l§a Đại Gia §c".$ten."§a Đã Nộp §e".$tien."§a Vào Ngân Hàng!");
				}else{
					$this->getServer()->getLogger()->notice("Đại Gia ".$ten." Đã Nạp ".$tien." Vào Bank!");
					return true;
				}
			}else{
				$sender->sendPopup("§cKhông Đủ tiền để gửi!");
				return true;
			}
		});
		
		$form->setTitle($this->tag);
		$form->addLabel("§aNhập Số Tiền cần nhập!");
		$form->addInput("§aAmount");
		$form->sendToPlayer($sender);
	}
	
	public function reduceMoney($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			$tien = $data[0];
			$ten = strtolower($sender->getName());
			$money = $this->EconomyAPI->myMoney($ten);
			if($this->xemTien($ten) >= $tien){
				$this->truTien($ten, $tien);
				$this->eco->addMoney($ten, $tien);
				$tien = (string)$tien;
				$sender->sendMessage("§fBạn đã lấy ra §a$tien §ftừ ngân hàng !");
				return true;
			}else{
				$sender->sendMessage("§Số tiền bạn rút nhiều hơn số tiền bạn hiện có !");
			}
		});
		$form->setTitle($this->tag);
		$form->addInput("§cAmount need Get");
		$form->sendToPlayer($sender);
	}
	
	public function checkMoney($sender){
		$ten = $sender->getName();
		$all = $this->nganhang->getAll();
		$money = $this->eco->myMoney($ten);
		$currentMoney = $this->xemTien($ten);
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle($this->tag);
		$form->addLabel("§a Số Dư Trong Tài Khoản:§e ". $currentMoney);
		$form->sendToPlayer($sender);
	}
	
	public function chuyenTien($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			$ten = strtolower($sender->getName());
			$tien = $data[2];
			if($this->kiemTra($ten)){
				if($this->xemTien($ten) >= strtolower($tien)){
					if(isset($data[1])){
						$this->truTien($ten, $tien);
						$this->congTien($data[1], $tien);
						foreach($this->getServer()->getOnlinePlayers() as $players){
							if(strtolower($data[1]) == strtolower($players->getName())){
								$nguoinhan = $players;
								break;
							}
						}
						if(isset($nguoinhan)){
							$nguoinhan->sendMessage("$ten §fđã chuyển cho bạn §a$t");
							return true;
						}
						$sender->sendMessage("$data[1] §cHiện Không Trực tuyến!");
						return true;
					}
				}
				$sender->sendMessage("§eSố tiền trong tài khoảng của bạn không đủ để thực hiện giao dịch nầy !");
                return true;
			}
			$sender->sendMessage("$data[1] §ckhông tồn tại trong dữ liệu của ngân hàng !");
		});
		$form->setTitle($this->tag);
		$form->addLabel("§aChuyển Khoản qua Người Bạn muốn!");
		$form->addInput("§aName");
		$form->addInput("Amount");
		$form->sendToPlayer($sender);
	}
}