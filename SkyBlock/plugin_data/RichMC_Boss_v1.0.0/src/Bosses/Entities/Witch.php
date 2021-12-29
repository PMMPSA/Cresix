<?php


namespace Bosses\Entities;


use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;

class Witch extends BossEntity
{

    public const NETWORK_ID = self::WITCH;
    /** @var float $width */
    public $width = 2.5;
    /** @var float $height */
    public $height = 2.5;


    public function initEntity(): void{
        parent::initEntity();
        $this->setNameTag("§l§bWitch§r§a Boss\n§c100§fHP");
        $this->setNameTagAlwaysVisible(true);
        $this->setMaxHealth(500);
        $this->setHealth(500);
        $this->setScale(1.5);
    }

    public function getName(): string{
        return "Witch";
    }

}