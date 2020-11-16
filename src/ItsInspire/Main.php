<?php

namespace ItsInspire;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener{

	public function onEnable(){ // THE START OBVIOUSLY
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("§aHypixel Replacements §ehas been activated.");
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
      switch (strtolower($cmd->getName())) {
        case "rmp": //THE COMMAND USED TO MAKE PEOPLE SAY THINGS
          if (count($args) < 2) {
            $sender->sendMessage("/rmp {player} {message}");
            return true;
        }
        $player = $this->getServer()->getPlayer(array_shift($args));
        if ($player instanceof Player) {
            $player->chat(trim(implode(" ", $args)));
            return true;
        } else {
            $sender->sendMessage("Invalid Player");
            return true;

        } //DO NOT REMOVE THIS
      }
      return true;
    }
    //-------------------
    // CHAT REPLACEMENTS
    //-------------------
    // Subscribe if this works :))
    // DO NOT COPY THIS CODE

    private $replacements = ["gay", "ez", "ezz", "ezzz", "gae", "gayy", "idiot", "stupid", "biosexual", "kys", "go die", "go suicide"];

	public function onChat(PlayerChatEvent $event): void{
		$msg = $event->getMessage();
		$player = $event->getPlayer();
		$playerName = $player->getName();
		//CHANGE THESE IF YOU WANT TO CHANGE THE REPLACEMENTS
		//IT MUST BE IN THIS FORMAT:
		//
		// $roasts = ["Replacement1", "Replacement2"];
		//etc...
		$roasts = ["ILY<3", "Why can't the Ender Dragon read a book? Because he always starts at the End.", "Pineapple doesn't go on pizza!", "You are very good at this game friend.", "Wait, This isn't what I typed!", "I sometimes try to say bad things and then this happens. :(", "Your personality shines like the sun!", "I have really enjoyed playing with you! <3", "Behold, the great and powerful, my magnificent and almighty nemesis!", "You're a great person! Do you want to play some games with me?", "In my free time I like to watch cat videos on YouTube.", "You are very good at this game friend.", "Please go easy on me, this is my first game!", "Anyone else really like Rick Astley?", "I like Minecraft PvP but you are truly better than me!", "ILY<3"];
		$roast = $roasts[array_rand($roasts)];
		foreach($this->replacements as $replacements){
			if(strpos($msg, $replacements) !== false){
				if(!$player->hasPermission("bypass.replacements")){
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "rmp " . $playerName . " ".$roast);
					$event->setCancelled();
					return;
				}
			}
		}
	}
}
/*
"ILY<3", "Why can't the Ender Dragon read a book? Because he always starts at the End.", "Pineapple doesn't go on pizza!", "You are very good at this game friend.", "Wait, This isn't what I typed!", "I sometimes try to say bad things and then this happens. :(", "Your personality shines like the sun!", "I have really enjoyed playing with you! <3", "Behold, the great and powerful, my magnificent and almighty nemesis!", "You're a great person! Do you want to play some games with me?", "In my free time I like to watch cat videos on YouTube.", "You are very good at this game friend."
*/
