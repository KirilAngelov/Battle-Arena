<?php
require_once "Commands.php";

class Hero extends Commands
{
    protected $name;
    protected $health;
    protected $stamina;
    public $tired = false;
    private $xp;
    private $xpCap = 100;


    //find hero by id and then map fields to parameters
    public function __construct($id)
    {

        parent::__construct('characters');
        $result = $this->getByPrimaryKey($id);
        $this->name = $result['name'];
        $this->health = $result['health'];
        $this->stamina = $result['stamina'];
        $this->xp = $result['xp'];
    }


    function attack(Hero $enemy, $damage)
    {
        if ($enemy->getHealth() > 0) {
            $newHeatlth = ($enemy->showHealth($enemy->name)-$damage);
            $this->setHealthDB($enemy->getName(),$newHeatlth);

        }
    }

    function winner($xp)
    {
      echo "{$this->name} won the battle with {$this->showHealth($this->name)} health and {$this->showStamina($this->name)} stamina left.<br />";
      $this->xp = $this->xp + $xp;
      echo "{$this->name} wins {$xp} experience points! Total: {$this->xp} <br />";
      $this->levelUp();
    }

    function levelUp()
    {
        if($this->xp >= $this->xpCap)
        {

            $this->health = $this->health + 15;
            $this->stamina = $this->stamina + 10;

                echo "{$this->name} levelled up!<br />";
                echo "New stats: {$this->health} health {$this->stamina} stamina.";
                $this->xp=0;

        }
    }


    public function isTired()
    {
        if ($this->showStamina($this->name) < 10) {
            $tired = true;
            echo "{$this->getName()} is tired and skips a turn to recover!<br />";

        }

    }


    public function getHealth()
    {

        return $this->health;
    }


    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function getStamina()
    {
        return $this->stamina;
    }


    public function setStamina($stamina)
    {
        $this->stamina = $stamina;
    }

    public function getName()
    {
        return $this->name;
    }
}