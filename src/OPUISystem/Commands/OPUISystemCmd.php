<?php

namespace OPUISystem\Commands;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;

use OPUISystem\Main;

class OPUISystemCmd extends PluginCommand{

    public function __construct($name, Main $plugin){
        parent::__construct($name, $plugin);
        $this->setDescription("Open OPSystem UI");
        $this->setAliases(["OPUI", "opui"]);
        $this->setPermission("pocketmine.command.opui");
    }

    public function OPUI($sender){
        if($sender instanceof Player){
          if($sender->hasPermission("pocketmine.command.opui")){
            $form = $this->getPlugin()->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $opcmd = "op ".$result." ".$data[0];
                $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $opcmd);
              }
            });
            $form->setTitle("§l§aOP");
            $form->addInput("§bUser");
            $form->sendToPlayer($sender);
          }
        }else{
          $sender->sendMessage("§cYou are not In-Game.");
        }
    return true;
  }

    public function DEOPUI($sender){
        if($sender instanceof Player){
          if($sender->hasPermission("pocketmine.command.opui")){
            $form = $this->getPlugin()->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $opcmd = "deop ".$result." ".$data[0];
                $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $opcmd);
              }
            });
            $form->setTitle("§l§cDEOP");
            $form->addInput("§bUser");
            $form->sendToPlayer($sender);
          }
        }else{
          $sender->sendMessage("§cYou are not In-Game.");
        }
    return true;
  }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
        if($sender instanceof Player){
          if($sender->hasPermission("pocketmine.command.opui")){
            $form = $this->getPlugin()->createSimpleForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
              }
		switch ($result) {
		   case 1:
                   $this->OPUI($sender);
		break;
		   case 2:
                   $this->DEOPUI($sender);
		break;
              }
            });
            $form->setTitle("§l§aOP§eSystem");
            $form->addButton("");
            $form->addButton("§bOP", 1);
            $form->addButton("§bDEOP", 2);
            $form->sendToPlayer($sender);
          }
        }else{
          $sender->sendMessage("§cYou are not In-Game.");
        }
    return true;
  }
}
