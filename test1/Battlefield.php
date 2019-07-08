
<?php
include "Hero.php";
include "Scenes.php";

class Battlefield
{
    private $warriorDamage = 30;
    private $orcDamage = 35;
    private $staminaCost = 10;
    private $enemyDamage=20;
    private $xpFromBattle=50;
    private $scenes;
    public function __construct()
    {
        $this->scenes= new Scenes();
    }

    public function Battle(Hero $hero1, Hero $hero2)
    {

        $var1 = $hero1->getName();
        $var2 = $hero2->getName();
        $turn = 0;

        echo "<br />";
        while($hero1->showHealth("$var1")>0 && $hero2->showHealth($var2) > 0)
        {

            //The idea is to switch turn as heroes attack.
            if($turn%2 == 0 && $hero1->showStamina($var1) >= $this->staminaCost )
            {
                //Here we check if the player chose the human or orc character.
                if (! empty($_POST['forPeople'])) {
                    $hero1->attack($hero2, $this->warriorDamage);

                    $stamina = $hero1->showStamina($var1) - $this->staminaCost;
                    $hero1->setStaminaDB($var1,$stamina);
                    if($hero2->showHealth($var2) <= 0)
                    {
                        echo "{$hero1->getName()} attacked {$hero2->getName()} for {$this->warriorDamage} points of damage and killed him!<br />";
                        $hero1->winner($this->xpFromBattle);

                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$this->warriorDamage} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->showHealth($var2)} health and {$hero2->showStamina($var2)} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }

                if(! empty($_POST['forHorde']))
                {
                    $hero1->attack($hero2, $this->orcDamage);
                    $stamina = $hero1->showStamina($var1) - $this->staminaCost;
                    $hero1->setStaminaDB($var1,$stamina);
                    if($hero2->showHealth($var2) <= 0)
                    {
                        echo "{$hero1->getName()} attacked {$hero2->getName()} for {$this->orcDamage} points of damage and killed him!<br />";
                        $hero1->winner($this->xpFromBattle);

                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$this->orcDamage} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->showHealth($var2)} health and {$hero2->showStamina($var2)} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }

            }
            else
            {
                $hero1->isTired();
                $hero1->setStaminaDB($var1 , 10);
                $turn++;
            }

            //Here is the enemy that attacks us on every odd turn.
            if($turn%2!=0 && $hero2->showStamina($var2) >= $this->staminaCost)
            {

                $hero2->attack($hero1, $this->enemyDamage);
                $hero2->setStamina($hero2->getStamina() - $this->staminaCost);

                if($hero1->showHealth($var1)<=0)
                {
                    echo "{$hero2->getName()} attacked {$hero1->getName()} for {$this->enemyDamage} points of damage and killed him!<br />";

                    return;
                }
                echo "{$hero2->getName()} attacked {$hero1->getName()} and dealt {$this->enemyDamage} point of damage.<br />";
                echo "{$hero1->getName()} has {$hero1->showHealth($var1)} health and {$hero1->showStamina($var1)} stamina points left.<br />";
                $turn++;
                echo "<mark class='blue'>Now it's {$hero1->getName()}'s turn!<br /></mark>";

            }
            else
            {
                $hero2->isTired();
                $hero2->setStamina($hero2->getStamina() + $this->staminaCost);
                $turn++;
            }

        }

    }
}


