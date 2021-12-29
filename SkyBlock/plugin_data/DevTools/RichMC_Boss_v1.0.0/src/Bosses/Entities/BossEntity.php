<?php

namespace Bosses\Entities;

use pocketmine\block\Block;
use pocketmine\block\Flowable;
use pocketmine\block\Slab;
use pocketmine\block\Stair;
use pocketmine\entity\Creature;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\Server;

abstract class BossEntity extends Creature {
	
	public $target;

	public $jumpTicks = 0;
	
    protected $persistent = false;

    public function entityBaseTick(int $tickDiff = 1): bool{
        parent::entityBaseTick($tickDiff);
        foreach(Server::getInstance()->getOnlinePlayers() as $player){
            if($player instanceof Player){
                $xDiff = $player->x - $this->x;
                $zDiff = $player->z - $this->z;
                $totalDiff = abs($xDiff) + abs($zDiff);
                if($this->distance($player) <= 5){
                    if (!$this->getTarget() == 0) {
                        $totalDiff = abs($xDiff) + abs($zDiff);
                        $this->motion->x = 1.2 * 0.30 * ($xDiff / $totalDiff);
                        $this->motion->z = 1.2 * 0.30 * ($zDiff / $totalDiff);
                        $player->attack(new EntityDamageEvent($this, EntityDamageEvent::CAUSE_ENTITY_ATTACK, 3));
                        $this->lookAt($player);
                    }else{
                        $this->motion->x = 1.2 * 0.30 * ($xDiff / $totalDiff);
                        $this->motion->z = 1.2 * 0.30 * ($zDiff / $totalDiff);
                        $this->findNewTarget();
                        $this->lookAt($player);
                    }
                }
            }
            if ($this->shouldJump()) {
                $this->jump();
            }
        }
        return true;
    }

    public function onCollideWithEntity(Entity $entity): void{
    }

    /**
     * @param Block $block
     */
    public function onCollideWithBlock(Block $block): void{
    }

    public function setPersistence(bool $persistent): self
    {
        $this->persistent = $persistent;
        return $this;
    }

    public function getFrontBlock($y = 0){
        $dv = $this->getDirectionVector();
        $pos = $this->asVector3()->add($dv->x * $this->getScale(), $y + 1, $dv->z * $this->getScale())->round();
        return $this->getLevel()->getBlock($pos);
    }

    public function shouldJump(){
        if($this->jumpTicks > 0) return false;
        return ($this->getFrontBlock(-0.5) instanceof Stair) || ($this->getFrontBlock(-1)->getId() != 0) || ($this->getFrontBlock(0.5)->getId() != 0) || ($this->getFrontBlock()->getId() != 0 || $this->getFrontBlock(-1) instanceof Stair) || ($this->getLevel()->getBlock($this->asVector3()->add(0,0,5)) instanceof Slab && (!$this->getFrontBlock(-0.5) instanceof Slab && $this->getFrontBlock(-0.5)->getId() != 0)) && $this->getFrontBlock(1)->getId() == 0 && $this->getFrontBlock(2)->getId() == 0 && $this->jumpTicks == 0 && !$this->getFrontBlock() instanceof Flowable;
    }

    public function getJumpMultiplier(){
        if($this->getFrontBlock(-0.5) instanceof Slab) return 10;
        if($this->getFrontBlock(-1) instanceof Slab) return 10;
        if($this->getFrontBlock() instanceof Slab) return 10;
        if($this->getFrontBlock(-0.5) instanceof Stair) return 10;
        if($this->getFrontBlock(-1) instanceof Stair) return 10;
        if($this->getFrontBlock() instanceof Stair) return 10;
        if($this->getFrontBlock()->getId() != 0) return 8;
        if($this->getFrontBlock(-0.5)->getId() != 0) return 8;
        if($this->getFrontBlock(-1)->getId() != 0) return 8;
        return 12;
    }

    public function jump(): void{
        $this->motion->y = $this->gravity * $this->getJumpMultiplier();
        $this->move($this->motion->x * 1.25, $this->motion->y, $this->motion->z * 1.25);
    }

    public function findNewTarget() {
        $target = null;
        foreach($this->getLevel()->getPlayers() as $player){
            if($this->distance($player) <= 15){
                $target = $player;
            }
        }
        $this->target = ($target != null ? $target->getName() : "");
    }

    public function hasTarget() {
        $target = $this->getTarget();
        if($target == null) return false;
        $player = $this->getTarget();
        return $player;
    }

    public function getTarget() {
        return Server::getInstance()->getPlayerExact((string) $this->target);
    }
}