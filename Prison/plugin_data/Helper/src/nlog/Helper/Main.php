<?php
namespace nlog\Helper;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Utils;
class Main extends PluginBase implements Listener{
	
public $pre = "§l§a[§6 HELPER§a ]§r ";
 	 public function onEnable(){
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
       
		$this->getLogger()->notice("§l§bPlugin Helper");
		$this->getLogger()->info("§l§eEnable");
    	
    	
    	//Config
    	@mkdir($this->getDataFolder(), 0744, true);
    	$this->helper = new Config($this->getDataFolder() . "office.yml", Config::YAML); //Config 생성
 	 }
 	 
 	 
 	 //경찰 API
 	 public function getHelper() {
 	 	/*
 	 	 * 경찰의 목록을 Config에서 가져옵니다.
 	 	 */
 	 	return $this->helper->getAll(true);
 	 }
 	 
 	 public function isHelper($name) {
 	 	/*
 	 	 * Config에 $name이 있으면 true를 없으면 false를 반환합니다.
 	 	 */
 	 	return $this->helper->exists($name);
 	 }
 	 
 	 public function setHelper($name) {
 	 	/*
 	 	 * 경찰을 Config에 추가합니다.
 	 	 */
 	 	$this->helper->set($name, "helper");
 	 	$this->helper->save();
 	 	return true;
 	 }
 	 
 	 public function removeHelper($name) {
 	 	/*
 	 	 * 경찰을 Config에서 제거합니다.
 	 	 */
 	 	$this->helper->remove($name, "helper");
 	 	$this->helper->save();
 	 	return true;
 	 }
 	 
 	 public function onCommand(CommandSender $sender,Command $cmd,string $label,array $args) :bool{
 	 	
 	 	$msg = "§7/helper <add | remove> <Username> \n §b§o[ Helper ] §7/helper list";
 	 	
 	 	if(strtolower($cmd->getName() === "helper")) {
 	 		if (!($sender->isOp())) {
 	 			$sender->sendMessage("§b§lBạn chưa đủ trình.");
 	 			return true; //OP 가 아닐 때 - 안전빵으로 한번 더ㅋㅋ
 	 		}
 	 		if (!(isset($args[0]))) {
 	 			$sender->sendMessage($msg);
 	 			return true;
 	 		}
			#-----------------------------------------------------------------------------
 	 		if ($args[0] === "add") {
 	 			if (!(isset($args[1]))) {
 	 				$sender->sendMessage($msg);
 	 				return true;
 	 			} //닉네임이 없을 때
				
 	 		$this->setHelper(strtolower($args[1]));
 	 		$sender->sendMessage($this->pre."§b§l Bạn vừa set helper cho §e".$args[1].".");
			return true;
 	 		}
			#-----------------------------------------------------------------------------
 	 		if ($args[0] === "remove") {
 	 			if (!(isset($args[1]))) {
 	 				$sender->sendMessage($msg);
 	 				return true;
 	 			} //닉네임이 없을 때
				
 	 		if (!($this->isHelper(strtolower($args[1])))) {
 	 				$sender->sendMessage($this->pre. "§c§lNgười này không có trong danh sách Helper.");
 	 				return true;
 	 			} //닉네임이 경찰이 아닐 때
				
 	 			$this->removeHelper($args[1]);
 	 			$sender->sendMessage($this->pre."§b§lXóa Helper của §e".$args[1]."§b thành công");
 	 			return true;
 	 		}
			#-----------------------------------------------------------------------------
 	 		if ($args[0] === "list") {
 	 			$list = implode("\n ", $this->getHelper());
 	 			$sender->sendMessage($this->pre."§b§oDanh sách Helper§a: " . $list);
 	 			return true; //리스트
				
			}else{
				$sender->sendMessage($msg);
				return true; //$args[0]이 없을 때
				
			}
 	 	}
 	 }
 	 
 	 public function onJoin (PlayerJoinEvent $ev) {
			$name = $ev->getPlayer()->getName();
			if ($this->isHelper(strtolower($name)) === true) {
				$per = $ev->getPlayer()->addAttachment($this);
				$per->setPermission("pocketmine.command.kick", true);
				$per->setPermission("pocketmine.command.teleport", true);
				$per->setPermission("pocketmine.command.list", true);
								$per->setPermission("fly.command", true);
				$per->setPermission("solobanmaster.command.police", true);
				$ev->getPlayer()->setDisplayName("§l§b•§aHelper§b• §r".$name);
				}
 	}
 	 
 	 public function onQuit (PlayerQuitEvent $ev) {
		$name = $ev->getPlayer()->getName();
 	 	$per = $this->getServer()->getPlayer($name)->addAttachment($this);
 	 	$per->setPermission("pocketmine.command.kick", false);
		$per->setPermission("fly.command", false);
 	 	$per->setPermission("pocketmine.command.teleport", false);
 	 	$per->setPermission("pocketmine.command.list", false);
 	 	$per->setPermission("solobanmaster.command.police", false);
 	 }
  }
?>
