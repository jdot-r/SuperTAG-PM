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
		if(!$this->config->get("settings")){
			$this->config->set("settings");
			$this->config->set("tagname", "[Admin]");
		}
		$this->config->save();
		$this->players=array();
		$this->st=0;
		$this->on=0;
	}
	
	public function OnCommand(CommandSender $sender, Command $command, $label, array $args){
		if($command->getName()){
			$sender->sendMessage("§6S§du§ep§be§fr§5T§aa§cg");
		}
		if(!isset($args[0])){unset($sender,$cmd,$label,$args);return false;};
		switch($args[0]){
		case "mode":
		    if(strtolower($args[1])==="off"){
				$this->on=0;
		    	$sender->sendMessage($args[1]."'s §cSuperTag OFF");
				$sender->setNameTag($sender->getName());
				$sender->setDisplayName($sender->getName());
		    }
		    if(strtolower($args[1])==="on")
			{
				$this->on=1;
		   $sender->sendMessage($args[1]."'s §aSuperTag ON");
		   isset($this->players[$sender->getName()]);
	       $this->players[$sender->getName()]=array("id"=>$sender->getName());
	       $this->st=6;
	       $this->supertag();
		   break;
		    }
		}
	}
	
	public function supertag(){
		if($this->config->get("tag", true) and $this->on==1){
			foreach($this->players as $pl){
				$p=$this->getServer()->getPlayer($pl["id"]);
				$this->st--;
				$name=$p->getName();
				$tag=$this->config->get("tagname");
				if($this->st==6){
					$p->setNameTag("§a-> §d" .$name. " §a<-");
					$p->setDisplayName("§a-> §d" .$name. " §a<-");
				}
				if($this->st==5){
					 $p->setNameTag("§a--> §d" .$name. " §a<--");
					 $p->setDisplayName("§a--> §d" .$name. " §a<--");
				}
				if($this->st==4){
					 $p->setNameTag("§a---> §d" .$name. " §a<---");
					 $p->setDisplayName("§a---> §d" .$name. " §a<---");
				if($this->st==3){
					 $p->setNameTag("§a----> §d" .$name. " §a<----");
					 $p->setDisplayName("§a----> §d" .$name. " §a<----");
				}
				if($this->st==2){
					 $p->setNameTag("§a@ §b" .$tag. " §a@");
					 $p->setDisplayName("§a@ §b" .$tag. " §a@");
				}
				if($this->st==1){
					 $p->setNameTag("§a@ §e" .$name. " §a@");
					 $p->setDisplayName("§a@ §e" .$name. " §a@");
				}
				if($this->st==0){
					$this->st=7;
				}
			}
			
		}
	}
}
}
?>