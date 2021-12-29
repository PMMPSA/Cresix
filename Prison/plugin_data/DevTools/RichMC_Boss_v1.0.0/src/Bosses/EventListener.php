<?php


namespace Bosses;


use Bosses\Entities\Witch;
use Bosses\Entities\Zombie;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\Player;

class EventListener implements Listener
{

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
    }

    public function onTap(PlayerInteractEvent $event) {
        $item = $event->getItem();
        $player = $event->getPlayer();
        if ($item->getId() === Item::BONE && $item->getDamage() === 1) {
            if (!$item->hasCustomBlockData()) return;
            $boss = $item->getCustomBlockData()->getString("boss");
            $bone = Item::get(Item::BONE, 1, 1);
            $touch = $event->getTouchVector();
            $spawnAt = $player->add($touch->getX(), $touch->getY(), $touch->getZ());
            $entity = Entity::createEntity($boss, $player->getLevel(), Entity::createBaseNBT($spawnAt));
				if($entity !== null){
            	 $entity->setNameTag("§l§6Zombie§r§a Boss\n§c100§fHP");
           	 	 $entity->setNameTagAlwaysVisible(true);
            	 $entity->spawnToAll();
           		 $player->getInventory()->removeItem($bone);
           		 $player->getServer()->broadcastMessage("§l§aBoss§6 Zombie§a Đã Được Triệu Hồi§r§c /warp boss§e Để Tiêu Diệt Nó Ngay Nào!");
				}
        }

        if ($item->getId() === Item::BONE && $item->getDamage() === 2) {
            if (!$item->hasCustomBlockData()) return;
            $boss = $item->getCustomBlockData()->getString("boss");
            $bone = Item::get(Item::BONE, 1, 1);
            $touch = $event->getTouchVector();
            $spawnAt = $player->add($touch->getX(), $touch->getY(), $touch->getZ());
            $entity = Entity::createEntity($boss, $player->getLevel(), Entity::createBaseNBT($spawnAt));
				 if($entity !== null){
             	$entity->setNameTag("§l§bWitch§r§a Boss\n§c100HP");
           	   $entity->setNameTagAlwaysVisible(true);
             	$entity->spawnToAll();
             	$player->getInventory()->removeItem($bone);
             	$player->getServer()->broadcastMessage("§l§aBoss§b Witch§a Đã Được Triệu Hồi§r§c /warp boss§e Để Tiêu Diệt Nó Ngay Nào!");
 				}
        }
    }

    public function onDeath(EntityDeathEvent $event) {
        $zombie = [
            Item::get(443, 0, 1)->setCustomName(""),
            Item::get(467, 0, mt_rand(1, 2))->setCustomName(""),
            Item::get(368, 0, 1)->setCustomName(""),
        ];

        $witch = [
            Item::get(130, 0, 1)->setCustomName(""),
            Item::get(213, 4, mt_rand(1, 2))->setCustomName(""),
            Item::get(138, 5, mt_rand(0, 1))->setCustomName(""),
            Item::get(332, 1, 16)->setCustomName(""),
        ];
        $boss = $event->getEntity();
        $cause = $event->getEntity()->getLastDamageCause();
        if (!$cause instanceof EntityDamageByEntityEvent) return;
        $damager = $cause->getDamager();
        if (!$damager instanceof Player) return;
        if ($boss instanceof Zombie) {
            $damager->getInventory()->addItem($zombie[array_rand($zombie)]);
        } elseif ($boss instanceof Witch) $damager->getInventory()->addItem($witch[array_rand($witch)]);
    }
}