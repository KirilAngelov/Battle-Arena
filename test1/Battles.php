<?php

include_once "Battlefield.php";
include_once "Hero.php";
include_once "Scenes.php";

class Battles
{

    private $bf;
    private $hero1;
    private $hero2;
    private $hero3;
    private $scene;
    public function __construct()
    {
        $this->hero1 = new Hero("Aragorn",70,60);
        $this->hero2 = new Hero("Orc",90,30);
        $this->hero3 = new Hero("General",80,10);
        $this->bf = new Battlefield();
        $this->scene = new Scenes();
        $this->check();
    }

    public function check()
    {
        //For now heroes are hard coded and we can't use the database properly.
        //The plan is to use the database because we will use different heroes
        //for different requests. Example when the request is 'Battle' we call
        //Hero1 vs Hero3. When the request is 'forPeople' it is Hero1 vs Hero2.
        // 'forHorde' will be Hero2 vs Hero1 and so on.
        if(isset($_POST['forPeople']) && $_POST['forPeople'] == 'Battle!')
        {

            $this->bf->Battle($this->hero1, $this->hero3);

        }
        elseif (isset($_POST['forHorde']) && $_POST['forHorde'] == 'Battle!') {

            $this->bf->Battle($this->hero2, $this->hero3);


        }
        elseif (! empty($_POST['forPeople'])) {


            $this->bf->Battle($this->hero1, $this->hero2);
            $this->scene->displayWarrior2();

        }
        elseif (isset($_POST['forHorde'])) {

            $this->bf->Battle($this->hero2, $this->hero1);
            $this->scene->displayOrc2();

        }

        else
            {
             echo 'Battle2';
            }

    }

}