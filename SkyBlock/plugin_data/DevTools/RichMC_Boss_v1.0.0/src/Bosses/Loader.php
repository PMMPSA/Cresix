<?php


namespace Bosses;

use Bosses\Commands\BossCommand;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase
{

    public function onEnable() {
        $this->getLogger()->info("BetterBosses by AstroPvP");
        EntityManager::init();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("command", new BossCommand($this));
    }

}