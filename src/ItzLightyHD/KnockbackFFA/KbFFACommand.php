<?php
declare(strict_types=1);

namespace ItzLightyHD\KnockbackFFA;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use function implode;

class KbFFACommand extends Command implements PluginIdentifiableCommand {

    /** @var KnockbackFFA $plugin */
    private $plugin;

    public function __construct(KnockbackFFA $plugin) {
        parent::__construct("kbffa", "Play an amazing minigame", "/kbffa");
        $this->plugin = $plugin;
    }

    public function getPlugin() : Plugin{
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): void {
        if(!($sender instanceof Player)) {
            $sender->sendMessage("§cOnly players can execute this command!");
            return;
        }
        $world = KnockbackFFA::getInstance()->getGameData()->get("arena");
        if(isset($args[0])) {
            if($args[0] === "kills") {
                    if(!isset($args[1])) {
                        $sender->sendMessage("§cUsage: /kbffa kills <player>");
                        return;
                    }
                    $player = Server::getInstance()->getPlayer($args[1]);
                    if($player->isOnline()) {
                        if(EventListener::getInstance()->getKillstreak($player->getName()) === "None") {
                            $sender->sendMessage("§8[§5KBFFA§8] §r§7§l» §r§e" . $player->getDisplayName() . " §r§6didn't play KnockbackFFA yet");
                        } else {
                            $sender->sendMessage("§8[§5KBFFA§8] §r§7§l» §r§e" . $player->getDisplayName() . " §r§6is at §e" . EventListener::getInstance()->getKillstreak(Server::getInstance()->getPlayer($args[1])->getName()) . " §6kills");
                        }
                    } else {
                        $sender->sendMessage("§8[§5KBFFA§8] §r§7§l» §r§c" . $args[1] . " isn't online!");
                    }
                return;
            }
        }
        $sender->teleport(Server::getInstance()->getLevelByName($world)->getSpawnLocation());
    }
}
