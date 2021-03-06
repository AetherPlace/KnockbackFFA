<?php

namespace ItzLightyHD\KnockbackFFA\event;

use ItzLightyHD\KnockbackFFA\Loader;
use pocketmine\event\Event;
use pocketmine\Player;

class PlayerKillEvent extends Event {

    protected $plugin;
    protected $player;
    protected $target;

    public function __construct(Player $player, Player $target)
    {
        $this->plugin = Loader::getInstance();
        $this->player = $player;
        $this->target = $target;
    }

    public function getPlugin(): Loader
    {
        return $this->plugin;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getTarget(): Player
    {
        return $this->target;
    }

}