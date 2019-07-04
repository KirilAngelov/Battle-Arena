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
        $str = "INSERT INTO heroes(Name, Health, Stamina)
                VALUES (:name,:health,:stamina)";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name,':health' => $health,':stamina' => $stamina];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }

    function delete($name)
    {
        $str = 'DELETE FROM heroes WHERE Name=:name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);

    }

    function showHealth($name)
    {
        $str ='SELECT Health FROM heroes WHERE Name=:name';

        $sth = ConnectDb::getInstance()->getConnection();
        $values =[':name'=>$name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value)
        {
            //use return for the value
            var_dump((int)$result[$key]);
        }
    }

//Must use return statement when used in game logic!
    function showStamina($name)
    {
        $str = 'SELECT Stamina FROM heroes WHERE Name=:name';
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

//Some text for clarification would be nice.
    function setHealth($name,$newHealth)
    {
        $str = 'UPDATE heroes SET Health = :newHealth WHERE Name = :name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newHealth' => $newHealth,':name' => $name];
        $stm =  $sth->prepare($str);
        $stm->execute($values);
    }


    function setStamina($name,$newStamina)
    {
        $str = 'UPDATE heroes SET Stamina = :newStamina WHERE Name = :name';
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newStamina' => $newStamina,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }


//Display all heroes
    function showAll()
    {
        $str = "SELECT * FROM heroes";
        $sth = ConnectDb::getInstance()->getConnection();

        $stm = $sth->prepare($str);
        $stm->execute();
        var_dump($stm->fetchAll(PDO::FETCH_ASSOC));

    }

}

