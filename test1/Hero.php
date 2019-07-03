<?php


class Hero
{
    protected $name;
    protected $health;
    protected $stamina;
    public $tired = false;

    public function __construct($name, $health, $stamina)
    {

        $this->name = $name;
        $this->health = $health;
        $this->stamina = $stamina;
    }

    function attack(Hero $enemy, $damage)
    {
        if ($enemy->getHealth() > 0) {
            $enemy->health = $enemy->health - $damage;

        }
    }

    function winner()
    {
      echo "{$this->name} won the battle with {$this->health} health and {$this->stamina} stamina left.";
    }


    public function isTired()
    {
        if ($this->stamina < 10) {
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