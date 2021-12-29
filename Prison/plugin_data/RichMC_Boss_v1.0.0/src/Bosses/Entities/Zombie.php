<?php


namespace Bosses\Entities;


use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;

class Zombie extends BossEntity
{

    public const NETWORK_ID = self::ZOMBIE;
    /** @var float $width */
    public $width = 2.5;
    /** @var float $height */
    public $height = 2.5;


    public function initEntity(): void{
        parent::initEntity();
        $this->setNameTag("§l§6Zombie§r§a Boss\n§c100§fHP");
        $this->setNameTagAlwaysVisible(true);
        $this->setMaxHealth(500);
        $this->setHealth(500);
        $this->setScale(1.5);
    }

    public function getName(): string{
        return "Zombie";
    }
}