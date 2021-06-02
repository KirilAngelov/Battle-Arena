
<?php


class Battlefield
{

    const STAMINA_COST = 10;
    const XP_FROM_BATTLE = 50;
    const STAMINA_RECOVER = 10;
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
            if($turn%2 == 0 && $hero1->getStamina() >= self::STAMINA_COST )
            {
                //Here we check if the player chose the human or orc character.
                if (! empty($_POST['final'])) {
                    $hero1->attack($hero2, $hero1->getDamage());

                    $stamina = $hero1->showStamina($var1) - self::STAMINA_COST;
                    $hero1->setStaminaDB($var1,$stamina);
                    if($hero2->showHealth($var2) <= 0)
                    {
                        echo "{$hero1->getName()} attacked {$hero2->getName()} for {$hero1->getDamage()} points of damage and killed him!<br />";
                        $hero1->winner(self::XP_FROM_BATTLE);
                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$hero1->getDamage()} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->showHealth($var2)} health and {$hero2->showStamina($var2)} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }
                if (! empty($_POST['forPeople'])) {
                    $hero1->attack($hero2, $hero1->getDamage());

                    $stamina = $hero1->showStamina($var1) - self::STAMINA_COST;
                    $hero1->setStaminaDB($var1,$stamina);
                    if($hero2->showHealth($var2) <= 0)
                    {
                        if($hero2->getName()=="Orc")
                        {
                            echo "{$hero2->getName()} managed to escape before the killing blow!<br />";
                        }
                        else {
                            echo "{$hero1->getName()} attacked {$hero2->getName()} for {$hero1->getDamage()} points of damage and killed him!<br />";
                        }
                        $hero1->winner(self::XP_FROM_BATTLE);
                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$hero1->getDamage()} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->showHealth($var2)} health and {$hero2->showStamina($var2)} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }

                if(! empty($_POST['forHorde']))
                {
                    $hero1->attack($hero2, $hero1->getDamage());
                    $stamina = $hero1->showStamina($var1) - self::STAMINA_COST;
                    $hero1->setStaminaDB($var1,$stamina);
                    if($hero2->showHealth($var2) <= 0)
                    {
                        if($hero2->getName()=="Aeneas")
                        {
                            echo "{$hero2->getName()} managed to escape before the killing blow!<br />";
                        }
                        else
                        {
                            echo "{$hero1->getName()} attacked {$hero2->getName()} for {$hero1->getDamage()} points of damage and killed him!<br />";
                        }
                        $hero1->winner(self::XP_FROM_BATTLE);
                        return;
                    }
                    echo "{$hero1->getName()} attacked {$hero2->getName()} and dealt {$hero1->getDamage()} point of damage.<br />";
                    echo "{$hero2->getName()} has {$hero2->showHealth($var2)} health and {$hero2->showStamina($var2)} stamina points left.<br />";
                    $turn++;
                    echo "<mark class='red'>Now it's {$hero2->getName()}'s turn!<br /></mark>";
                }

            }
            else
            {
                $hero1->isTired();
                $hero1->setStaminaDB($var1,self::STAMINA_RECOVER);
                $turn++;
            }

            //Here is the enemy that attacks us on every odd turn.
            if($turn%2!=0 && $hero2->showStamina($var2) >= self::STAMINA_COST)
            {

                $hero2->attack($hero1, $hero2->getDamage());
                $hero2->setStamina($hero2->getStamina() - self::STAMINA_COST);

                if($hero1->showHealth($var1)<=0)
                {
                    echo "{$hero2->getName()} attacked {$hero1->getName()} for {$hero2->getDamage()} points of damage and killed him!<br />";
                    return;
                }
                echo "{$hero2->getName()} attacked {$hero1->getName()} and dealt {$hero2->getDamage()} point of damage.<br />";
                echo "{$hero1->getName()} has {$hero1->showHealth($var1)} health and {$hero1->showStamina($var1)} stamina points left.<br />";
                $turn++;
                echo "<mark class='blue'>Now it's {$hero1->getName()}'s turn!<br /></mark>";

            }
            else
            {
                $hero2->isTired();
                $hero2->setStamina($hero2->getStamina() + self::STAMINA_RECOVER);
                $turn++;
            }

        }

    }
}

