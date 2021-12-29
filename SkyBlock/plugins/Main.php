<?php

namespace haste;

use pocketmine\{Server, Player};
use pocketmine\command\{ConsoleCommandSender, Command, CommandSender};
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;

Class Main extends PluginBase implements Listener{

public function onEnable():void{
		$this->getLogger()->info("Plugin make By hera");
	   }

public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
   	$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "haste":
$player->addEffect(new EffectInstance::getEffect(Effect::HASTE));
}
return true;
}
}