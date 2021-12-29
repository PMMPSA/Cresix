<?php
declare(strict_types = 1);

/**
 * @name TokenAPI
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\TokenAddon
 * @depend TokenAPI
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use pocketmine\Player;

	class TokenAddon extends AddonBase{

		/** @var EconomyAPI */
		private $economyAPI;

		public function onEnable(): void{
			$this->economyAPI = $this->getServer()->getPluginManager()->getPlugin("TokenAPI");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{token}" => $this->economyAPI->myMoney($player)
			];
		}
	}
}