<?php


class Battles
{

    private $bf;
    private $hero1;
    private $hero2;
    private $hero3;
    private $hero4;
    private $boss;
    private $scene;
    public function __construct()
    {


        //It will be better to call the Hero __construct and search by ID.
        $this->hero1 = new Hero(1);
        $this->hero2 = new Hero(2);
        $this->hero3 = new Hero(3);
        $this->hero4= new Hero(4);
        $this->boss = new Hero(6);
        $this->bf = new Battlefield();
        $this->scene = new Scenes();

        $this->check();

    }

    public function check()
    {

        //The plan is to use the database because we will use different heroes
        //for different requests. Example when the request is 'Battle' we call
        //Hero1 vs Hero3. When the request is 'forPeople' it is Hero1 vs Hero2.
        // 'forHorde' will be Hero2 vs Hero1 and so on.
        if(isset($_POST['final']) && $_POST['final'] == 'Onwards!')
        {
           $this->bf->Battle($this->hero2,$this->boss);
            $this->bf->Battle($this->hero1,$this->boss);
            $this->scene->ending();

        }
        if(isset($_POST['forPeople']) && $_POST['forPeople'] == 'Battle!')
        {

            $this->bf->Battle($this->hero1, $this->hero3);
            $this->scene->displayShop();

        }
        elseif (isset($_POST['forHorde']) && $_POST['forHorde'] == 'Battle!') {

            //add hero4 to DB and replace here
            $this->bf->Battle($this->hero2, $this->hero4);
            $repo = new HeroRepository();
            $repo->setStaminaDB("Aeneas",$repo->showStamina("Aeneas")+10);
            $repo->setHealthDB("Aeneas",$repo->showHealth("Aeneas")+20);
            $this->scene->displayShop();


        }
        elseif (! empty($_POST['forPeople'])) {

            $this->bf->Battle($this->hero1, $this->hero2);
            $this->scene->displayWarrior2();

        }
        elseif (isset($_POST['forHorde'])) {

            $this->bf->Battle($this->hero2, $this->hero1);
            $this->scene->displayOrc2();

        }


    }

}