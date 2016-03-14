<?php
namespace SuperTag;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Renk;
use pocketmine\utils\Config;
use pocketmine\scheduler\CallbackTask;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;

class SuperTag extends PluginBase implements Listener{
	
	public function OnEnable(){
		$this->getLogger()->info("§aSUPERTAG§b Has Been Enabled!");
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this, "supertag"]), 20);
		@mkdir($this->getDataFolder());
		$this->config=new Config($this->getDataFolder() . "config.yml", Config::YAML);
		if(!$this->config->get("settings:")){
			$this->config->set("settings:");
			$this->config->set("tag", true);
			$this->config->set("tagname", "[Admin]");
		}
		$this->config->save();
		$this->players=array();
		$this->st=0;
	}
	
	public function OnCommand(CommandSender $sender, Command $command, $label, array $args){
		if($command->getName()){
			$sender->sendMessage("§6S§du§ep§be§fr§5T§aa§cg");
		}
		if(!isset($args[0])){unset($sender,$cmd,$label,$args);return false;};
		switch($args[0]){
		case "mode":
		    if($this->config->get("tag", true)){
		    	$this->config->set("tag", false);
		    	$sender->sendMessage("§cSuperTag OFF");
		    	unset($this->players[$sender->getName()]);
		    }
		    if($this->config->get("tag", faLse)){
		    	$this->config->set("tag", true);
		    	$sender->sendMessage("§aSuperTag ON");
		    	isset($this->players[$sender->getName()]);
	       $this->players[$sender->getName()]=array("id"=>$sender->getName());
	       $this->st=6;
	       $this->supertag();
	       break;
		    }
		}
	}
	
	public function supertag(){
		if($this->config->get("tag", true){
			foreach($this->players as $pl){
				$this->st--;
				$name=$p->getName();
				$tag=$this->config->get("tagname");
				$p=$this->getServer()->getPlayer($pl["id"]);
				if($this->st==5){
					$p->setNameTag("§1" .$tag. "§r" .$name. "§2" .$tag);
				}
				if($this->ss==4){
					 $p->setNameTag("§3" .$tag. "§r" .$name. "§4" .$tag);
				}
				if($this->ss==3){
					 $p->setNameTag("§5" .$tag. "§r" .$name. "§6" .$tag);
				}
				if($this->ss==2){
					 $p->setNameTag("§e" .$tag. "§r" .$name. "§d" .$tag);
				}
				if($this->ss==1){
					 $p->setNameTag("§b" .$tag. "§r" .$name. "§a" .$tag);
				}
				if($this->ss==0){
					$this->ss=6;
				}
			}
			
		}
	}
}
?>
