<?php

namespace FAMIMA\SpawnPointParticle;

use pocketmine\plugin\PluginBase;
use pocketmine\level\particle\DustParticle;
use pocketmine\scheduler\CallbackTask;
use pocketmine\math\Vector3;

class Main extends PluginBase
{
  private $level;
  private $server;
  //private $callback;

  public function onEnable()
  {
    $this->level = ($this->server = $this->getServer())->getDefaultLevel();
    $callback = new CallbackTask([$this, "Ptcl"], [new Vector3(128, 9, 128), 0]);
    $this->server->getScheduler()->scheduleDelayedTask($callback, 2);
  }

  public function Ptcl($pos, $rag)
  {
    /*$rag += 30;
    $r = deg2rad($rag);
    $r2 = deg2rad($rag+180);
    $this->level->addParticle(new DustParticle($pos->add(sin($r)*1.5, 0, cos($r)*1.5), 255, 0, 0));
    $this->level->addParticle(new DustParticle($pos->add(sin($r2)*1.5, 0, cos($r2)*1.5), 255, 255, 255));
    $callback = new CallbackTask([$this, "Ptcl"], [new Vector3(128, 9, 128), $rag]);
    */
    //for($a = 0; $a < 5; $a++){
      $rad = deg2rad($rag);
      for($b = 0.1; $b < 2; $b += 0.1)$this->level->addParticle(new DustParticle($pos->add(cos($rad)*$b, 1, sin($rad)*$b), 255, ($b > 1.8) ? 0 : 255, ($b > 1.8) ? 0 : 255));
      $rag += 10;
    //}
    $rag = ($rag > 360) ? $rag - 360 : $rag;
    $callback = new CallbackTask([$this, "Ptcl"], [new Vector3(128, 9, 128), $rag]);
    $this->server->getScheduler()->scheduleDelayedTask($callback, 2);
  }
}
