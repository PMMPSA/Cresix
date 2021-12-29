<?php

namespace Bosses\Commands;

use Bosses\Loader;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;

class BossCommand extends PluginCommand
{

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct("boss", $plugin);
        $this->setDescription("§l§cCresix§c Boss Command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void{
        if(!$sender->hasPermission("betterbosses.command")){
            $sender->sendMessage("§cYou do not have permission to use this command");
            return;
        }
        if(empty($args[0])){
            $sender->sendMessage("§7Usage: /boss (type) (player)");
            return;
        }
        $bosses = [
            "zombie" => [
                "zombie",
                Item::get(Item::BONE, 1)
                    ->setCustomName("§l§6Zombie§r§a Boss§r§c (Right Click)")
                    ->setLore([
                        "§l§eClick§r§e To Spawn Boss",
                        "§r§4DANGER:§c Zombie Boss Is §eThe King ",
                        "",
                        "§r§7(!) Right-Click to summon §l§6Zombie§r§a Boss"
                    ])
                    ->setCustomBlockData(new CompoundTag("", [
                        new StringTag("boss", "zombie")
                    ]))
            ],
            "witch" => [
                "witch",
                Item::get(Item::BONE, 2)
                    ->setCustomName("§l§bWitch§r§a Boss§r§c (Right Click)")
                    ->setLore([
                        "§l§eClick§r§e To Spawn Boss",
                        "§r§4DANGER:§c Witch Boss Is §eThe King ",
                        "",
                        "§r§7(!) Right-Click to summon §l§bWitch§r§a Boss"
                    ])
                    ->setCustomBlockData(new CompoundTag("", [
                        new StringTag("boss", "witch")
                    ]))
            ]
        ];
        if(empty($bosses[strtolower($args[0])])){
            $sender->sendMessage("§cBoss not found. List of bosses: " . implode(", ", array_keys($bosses)));
            return;
        }
        $boss = $bosses[strtolower($args[0])];
        $item = $boss[1];
        if(!empty($args[1])){
            $target = $sender->getServer()->getPlayer($args[1]);
            if (!$target instanceof Player) return;
            if(!$target->hasPlayedBefore()){
                $sender->sendMessage("§cPlayer cannot be found");
                return;
            }
            $target->getInventory()->addItem($item);
            $target->sendMessage("§7You have received a " . $boss[0] . " summoner!");
            return;
        }
        if(!$sender instanceof Player){
            $sender->sendMessage("§cUse command in-game");
            return;
        }
        $sender->getInventory()->addItem($item);
        $sender->sendMessage("§7You have received a " . $boss[0] . " summoner!");
    }

}