<?php

/*
*   _____      _ _ 
*  / ____|    | | |
* | (___   ___| | |
*  \___ \ / _ \ | |
*  ____) |  __/ | |
* |_____/ \___|_|_|
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*/

namespace SellHand;

use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener
{
	/** @var Config */
	private $messages , $sell;

	public function onEnable() : void
	{
		$files = array("sell.yml" , "messages.yml");
		foreach ($files as $file) {
			if (!file_exists($this->getDataFolder() . $file)) {
				@mkdir($this->getDataFolder());
				file_put_contents($this->getDataFolder() . $file , $this->getResource($file));
			}
		}
		$this->getServer()->getPluginManager()->registerEvents($this , $this);
		$this->sell = new Config($this->getDataFolder() . "sell.yml" , Config::YAML);
		$this->messages = new Config($this->getDataFolder() . "messages.yml" , Config::YAML);
		$this->rebirths = $this->getServer()->getPluginManager()->getPlugin("Rebirth");
	}
	
	/**
	 * @param CommandSender $sender
	 * @param Command       $cmd
	 * @param string        $label
	 * @param array         $args
	 * @return bool
	 */
	public function onCommand(CommandSender $sender , Command $cmd , string $label , array $args) : bool{
		switch (strtolower($cmd->getName())) {
			case "sell":

				/* Checks if command is executed by console. */
				/* It further solves the crash problem. */
				if (!($sender instanceof Player)) {
					$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::DARK_RED . "Dùng lệnh này trong game!");
				}

				/* Check if the player is permitted to use the command */
				if ($sender->hasPermission("sell") || $sender->hasPermission("sell.hand") || $sender->hasPermission("sell.all")) {

					/* Disallow non-survival mode abuse */
					if (!($sender->isSurvival())) {
						$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::DARK_RED . "Vui lòng chuyển về chế độ sinh tồn.");
					}

					/* Sell Hand */
					if (isset($args[0]) && strtolower($args[0]) == "hand") {

						if (!$sender->hasPermission("sell.hand")) {
							$error_handPermission = $this->messages->get("error-nopermission-sellHand");
							$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::RED . $error_handPermission);
						}

						$item = $sender->getInventory()->getItemInHand();
						$itemId = $item->getId();
						/* Check if the player is holding a block */
						if ($item->getId() === 0) {
							$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::DARK_RED . "Bạn đang không cầm 1 khối hay vật phẩm nào.");
						}

						/* Recheck if the item the player is holding is a block */
						if ($this->sell->get($itemId) == null) {
							$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::GREEN . $item->getName() . TF::DARK_RED . " không thể bán.");
						}

						/* Sell the item in the player's hand */
						EconomyAPI::getInstance()->addMoney($sender , $this->sell->get($itemId) * $item->getCount());
						$sender->getInventory()->removeItem($item);
						$price = $this->sell->get($item->getId()) * $item->getCount();
						$rebirth = $price * ($this->rebirths->getRebirth($sender));
						$sender->sendMessage(TF::GREEN . TF::BOLD . "(!) " . TF::RESET . TF::GREEN . "" . $price . " xu đã được thêm vào tài khoản của bạn.");
						$sender->sendMessage(TF::GREEN . "Đã bán " . TF::RED . "" . $price . TF::GREEN . " xu (" . $item->getCount() . " " . $item->getName() . " cho " . $this->sell->get($itemId) . " xu mỗi cái).");
						if($this->rebirths->getRebirth($sender) > 0){
						$sender->sendMessage(TF::GREEN . TF::BOLD . TF::GREEN . "§r§a§l(!)§r " . $rebirth . "xu đã được thêm vào tài khoản của bạn (Rebirth)");
						EconomyAPI::getInstance()->addMoney($sender, $price * ($this->rebirths->getRebirth($sender)));
						}
						/* Sell All */
					} elseif (isset($args[0]) && strtolower($args[0]) == "all") {

						if (!$sender->hasPermission("sell.all")) {
							$error_allPermission = $this->messages->get("error-nopermission-sellAll");
							$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::RED . $error_allPermission);
						}

						$items = $sender->getInventory()->getContents();
						foreach ($items as $item) {
							if ($this->sell->get($item->getId()) !== null && $this->sell->get($item->getId()) > 0) {
								$price = $this->sell->get($item->getId()) * $item->getCount();
								$rebirth = $price * ($this->rebirths->getRebirth($sender));
								EconomyAPI::getInstance()->addMoney($sender , $price);
								$sender->sendMessage(TF::GREEN . TF::BOLD . "(!) " . TF::RESET . TF::GREEN . "Đã bán " . TF::RED . "" . $price . TF::GREEN . " xu (" . $item->getCount() . " " . $item->getName() . " cho " . $this->sell->get($item->getId()) . " xu mỗi cái).");
								if($this->rebirths->getRebirth($sender) > 0){
									$sender->sendMessage("§r§a§l(!)§r " . $rebirth . "xu đã được thêm vào tài khoản của bạn (Rebirth)");
									EconomyAPI::getInstance()->addMoney($sender, $price * ($this->rebirths->getRebirth($sender)));
								$sender->getInventory()->remove($item);
							}
						}
						}

					} elseif (isset($args[0]) && strtolower($args[0]) == "about") {
						$sender->sendMessage(TF::RED . TF::BOLD . "(!) " . TF::RESET . TF::GRAY . "Máy chủ này dùng Sell Hand của Muqsit Rayyan.");
					} else {
						$sender->sendMessage(TF::RED . TF::BOLD . "(!) " . TF::RESET . TF::DARK_RED . "Chợ bán đồ Online");
						$sender->sendMessage(TF::RED . "- " . TF::DARK_RED . "/sell hand " . TF::GRAY . "- Bạn vật phẩm trên tay bạn.");
						$sender->sendMessage(TF::RED . "- " . TF::DARK_RED . "/sell all " . TF::GRAY . "- Bán những gì có thể trong túi đồ của bạn.");
					}
				} else {
					$error_permission = $this->messages->get("error-permission");
					$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::RED . $error_permission);
				}
		}
		return true;
	}
}