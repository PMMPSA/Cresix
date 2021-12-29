<?php


namespace Bosses;


use Bosses\Entities\Witch;
use Bosses\Entities\Zombie;
use pocketmine\entity\Entity;

class EntityManager extends Entity
{

    public static function init(): void
    {
        self::registerEntity(Witch::class, true, ["witch"]);
        self::registerEntity(Zombie::class, true, ["zombie"]);
    }
}