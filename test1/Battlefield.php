
<?php
include "Hero.php";


class Battlefield
{
    private $warriorDamage = 22;
    private $orcDamage = 35;

    public function __construct()
    {
    }

    public function Battle(Hero $hero1, Hero $hero2)
    {
        $turn = 0;
        while(($hero1->getHealth() > 0) && $hero2->getHealth() > 0)
        {
            //The idea is to switch turn as heroes attack.
            if($turn%2 == 0 && $hero1->getStamina() >= 10 )
            {
                //Here we check if the player chose the human or orc character.
                if (! empty($_POST['forPeople'])) {
                    $hero1->attack($hero2, $this->warriorDamage);
                    $hero1->setStamina($hero1->getStamina() - 10);

                    if($hero2->getHealth() <= 0)
                    {
                        echo "{$hero1->getName()} attacked {$hero2->getName()} for {$this->warriorDamage} points of damage and killed him!<br />";
                        $hero1->winner();
                        $hero1->displayWarrior2();

                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$this->warriorDamage} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->getHealth()} health and {$hero2->getStamina()} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }

                if(! empty($_POST['forHorde']))
                {
                    $hero1->attack($hero2, $this->orcDamage);
                    $hero1->setStamina($hero1->getStamina() - 10);

                    if($hero2->getHealth() <= 0)
                    {
                        echo "{$hero1->getName()} attacked {$hero2->getName()} for {$this->orcDamage} points of damage and killed him!<br />";
                        $hero1->winner();
                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$this->orcDamage} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->getHealth()} health and {$hero2->getStamina()} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }

            }
            else
            {
                $hero1->isTired();
                $hero1->setStamina($hero1->getStamina() + 10);
                $turn++;
            }

            //Here is the enemy that attacks us on every odd turn.
            if($turn%2!=0 && $hero2->getStamina() >= 10)
            {

                $hero2->attack($hero1, 20);
                $hero2->setStamina($hero2->getStamina() - 10);

                if($hero1->getHealth()<=0)
                {
                    echo "{$hero2->getName()} attacked {$hero1->getName()} for 20 points of damage and killed him!<br />";

                    return;
                }
                echo "{$hero2->getName()} attacked {$hero1->getName()} and dealt 20 point of damage.<br />";
                echo "{$hero1->getName()} has {$hero1->getHealth()} health and {$hero1->getStamina()} stamina points left.<br />";
                $turn++;
                echo "<mark class='blue'>Now it's {$hero1->getName()}'s turn!<br /></mark>";
            }
            else
            {
                $hero2->isTired();
                $hero2->setStamina($hero2->getStamina() + 10);
                $turn++;
            }

        }
    }
}


