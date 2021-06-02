<?php
class Hero extends HeroRepository
{
    protected $name;
    protected $health;
    protected $stamina;
    public $tired = false;
    private $xp;
    private $damage;
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
        $this->damage = $result['damage'];
    }


    function attack(Hero $enemy, $damage)
    {
        if ($enemy->getHealth() > 0) {
            $newHeatlth = ($enemy->getHealth()-$damage);
            $this->setHealthDB($enemy->getName(),$newHeatlth);

        }
    }

    function winner($xp)
    {
      echo "{$this->name} won the battle with {$this->getHealth($this->name)} health and {$this->getStamina($this->name)} stamina left.<br />";
      $this->xp = $this->xp + $xp;
      echo "{$this->name} wins {$xp} experience points! Total: {$this->xp} <br />";
      $this->addXpToHeroDB($this->name,$xp);
      $this->levelUp();
      $this->setStamina($this->getStamina()+10);
    }

    function levelUp()
    {
        if($this->xp >= $this->xpCap)
        {

            $this->stamina = $this->stamina + 10;
            $newHealth = $this->getHealth() + 15;
            $newStamina = $this->getStamina() + 15;
            $this->setHealth($newHealth);
            $this->setStamina($newStamina);

                echo "{$this->name} levelled up!<br />";
                echo "New stats: {$this->getHealth()} health {$this->getStamina()} stamina.";
                $this->resetXp();

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

        $this->health = $this->showHealth($this->name);
        return $this->health;
    }


    public function setHealth($health)
    {
        $this->health = $this->setHealthDB($this->name,$health);
    }

    public function getStamina()
    {
        $this->stamina = $this->showStamina($this->name);
        return $this->stamina;
    }
    function resetXp()
    {
        $this->xp = $this->addXpToHeroDB($this->name,0);
    }

    public function setStamina($stamina)
    {
        $this->stamina = $this->setStaminaDB($this->name,$stamina);
    }
    public function getDamage()
    {
        $this->damage = $this->showDamage($this->name);
        return $this->damage;
    }

    public function getName()
    {
        return $this->name;
    }
}