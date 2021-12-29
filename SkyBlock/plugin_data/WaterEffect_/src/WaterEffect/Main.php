<?php

declare(strict_types=1);

namespace WaterEffect;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    
    const PREFIX = TextFormat::BOLD. TextFormat::YELLOW .'( '.TextFormat::RED. ' Bạn đang bị nhiểm độc hãy thoát khỏi nước'. TextFormat::YELLOW. ' )';

    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::BOLD. TextFormat::YELLOW .'PLUGIN BY PHUONGAZ');
    }


    public function onPlayerMove(PlayerMoveEvent $ev): void{
        $player = $ev->getPlayer();
        $block = $player->getLevel()->getBlock($player->floor()->subtract(0, 1));
        if($block->getId() == 8 || $block->getId() == 9){
        $effectID = Effect::getEffect(20);
        $duration = 3;
        $amplifier = 3;
        $visible = true;
        $player->addEffect(new EffectInstance($effectID, $duration * 30, $amplifier, $visible));
        $player->sendPopup(self::PREFIX);
        }
    }
}