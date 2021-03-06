<?php

namespace RandomBlockGen;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\block\IronOre;
use pocketmine\block\Cobblestone;
use pocketmine\block\DiamondOre;
use pocketmine\block\EmeraldOre;
use pocketmine\block\GoldOre;
use pocketmine\block\CoalOre;
use pocketmine\block\LapisOre;
use pocketmine\block\RedstoneOre;
use pocketmine\block\Water;
use pocketmine\block\Fence;
use pocketmine\utils\TextFormat as TF;

class Generate extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info(TF::GREEN."Plugin Enabled!");
		$this->getLogger()->info(TF::AQUA."Edited by ".TF::GOLD."KhoaGamingPro");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }
	
	public function onDisable(){
        $this->getLogger()->info(TF::RED."Plugin Disabled!");
	}

        public function onBlockSet(BlockUpdateEvent $event){
        $block = $event->getBlock();
        $water = false;
        $fence = false;
        for ($i = 2; $i <= 5; $i++) {
            $nearBlock = $block->getSide($i);
            if ($nearBlock instanceof Water) {
                $water = true;
            } else if ($nearBlock instanceof Fence) {
                $fence = true;
            }
            if ($water && $fence) {
                $id = mt_rand(1, 20);
                switch ($id) {
                    case 2;
                        $newBlock = new IronOre();
                        break;
                    case 4;
                        $newBlock = new GoldOre();
                        break;
                    case 6;
                        $newBlock = new EmeraldOre();
                        break;
                    case 8;
                        $newBlock = new CoalOre();
                        break;
                    case 10;
                        $newBlock = new RedstoneOre();
                        break;
                    case 12;
                        $newBlock = new DiamondOre();
                        break;
                    default:
                        $newBlock = new Cobblestone();
                }
                $block->getLevel()->setBlock($block, $newBlock, true, false);
                return;
            }
        }
    }
}
