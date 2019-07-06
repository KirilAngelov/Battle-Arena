<?php

include_once "ConnectDb.php";
include_once "Hero.php";
class Commands
{
    public $sth;
    public function __construct()
    {
    }

    function createHero($name, $health, $stamina)
    {
        $str = "INSERT INTO characters(Name, Health, Stamina)
                VALUES (:name,:health,:stamina)";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name,':health' => $health,':stamina' => $stamina];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }

    function delete($name)
    {
        $str = 'DELETE FROM characters WHERE Name=:name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);

    }
    function getById($id)
    {
        $str = 'SELECT name,health,stamina,xp FROM characters WHERE id=:id';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':id' => $id];


        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;

    }


    function showName($name)
    {
        $str = 'SELECT name FROM characters WHERE name=:name';

        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            //use return for the value
            var_dump($result[$key]);
        }
    }
    function showHealth($name)
    {
        $str ='SELECT health FROM characters WHERE name=:name';

        $sth = ConnectDb::getInstance()->getConnection();
        $values =[':name'=>$name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value)
        {
            //use return for the value
            var_dump($result[$key]);
        }
    }

//Must use return statement when used in game logic!
    function showStamina($name)
    {
        $str = 'SELECT stamina FROM characters WHERE Name=:name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value)
        {
            //use return for the value
            var_dump((int)$result[$key]);
        }
    }
    function showXp($name)
    {
        $str = 'SELECT xp FROM characters WHERE Name=:name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }


//Display all heroes
    function showAll()
    {
        $str = "SELECT * FROM characters";
        $sth = ConnectDb::getInstance()->getConnection();

        $stm = $sth->prepare($str);
        $stm->execute();
        var_dump($stm->fetchAll(PDO::FETCH_ASSOC));

    }

//Some text for clarification would be nice.
    function setHealth($name,$newHealth)
    {
        $str = 'UPDATE characters SET health = :newHealth WHERE Name = :name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newHealth' => $newHealth,':name' => $name];
        $stm =  $sth->prepare($str);
        $stm->execute($values);
    }


    function setStamina($name,$newStamina)
    {
        $str = 'UPDATE characters SET stamina = :newStamina WHERE Name = :name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newStamina' => $newStamina,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }
    function setXp($name,$newXp)
    {
        $str = 'UPDATE characters SET xp = :newXp WHERE Name = :name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newXp' => $newXp,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);

    }

    function defaultStats()
    {
        $this->setHealth("Aragorn",70);
        $this->setHealth("Orc",90);
        $this->setHealth("General",80);
        $this->setHealth("Tribe Leader",100);
        $this->setStamina("Aragorn",60);
        $this->setStamina("Orc",10);
        $this->setStamina("General",30);
        $this->setStamina("Tribe Leader",20);
    }

}

