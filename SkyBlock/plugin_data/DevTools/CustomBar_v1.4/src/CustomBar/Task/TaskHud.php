<?php

namespace CustomBar\Task;

use pocketmine\scheduler\Task;


class TaskHud extends Task
{

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }
    // onRun Task
    public function onRun(int $tick)
    {
        $pl = $this->plugin->getServer()->getOnlinePlayers();
        foreach ($pl as $player) {
            $text = $this->plugin->formatHUD($player);
            $player->sendPopup($text);
        }
    }
}
