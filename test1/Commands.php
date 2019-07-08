<?php

include_once "ConnectDb.php";
include_once "Hero.php";
 class Commands
{
    public $sth;
    private $tableName;
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    function createHero($name, $health, $stamina)
    {
        $str = "INSERT INTO " .$this->tableName." (Name, Health, Stamina)
                VALUES (:name,:health,:stamina)";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name,':health' => $health,':stamina' => $stamina];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }

    function deleteByPrimaryKey($id)
    {
        $str = "DELETE FROM " .$this->tableName. " WHERE id=:id";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':id' => $id];
        $stm = $sth->prepare($str);
        $stm->execute($values);

    }

    function getByPrimaryKey($id)
    {
        $str = "SELECT name,health,stamina,xp FROM " .$this->tableName. " WHERE id=:id";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':id' => $id];
        $stm = $sth->prepare($str);
       $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    function showName($id)
    {
        $str = "SELECT name FROM " .$this->tableName. " WHERE id=:id";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':id' => $id];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            //use return for the value
            return ($result[$key]);
        }
    }
    function getIdByName($name)
    {
        $str = "SELECT id FROM " .$this->tableName. " WHERE name=:$name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            //use return for the value
            return ($result[$key]);
        }
    }

    function showHealth($name)
    {
        $str ="SELECT health FROM " .$this->tableName. " WHERE name=:name";

        $sth = ConnectDb::getInstance()->getConnection();
        $values =[':name'=>$name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ((array) $result as $key=>$value)
        {
            //use return for the value
             return $result[$key];
        }
    }

//Must use return statement when used in game logic!
    function showStamina($name)
    {
        $str = "SELECT stamina FROM " .$this->tableName. " WHERE Name=:name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ((array) $result as $key=>$value)
        {
            //use return for the value

            return (int)$result[$key];
        }
    }
    function showXpDB($name)
    {
        $str = "SELECT xp FROM " .$this->tableName. " WHERE Name=:name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ((array) $result as $key=>$value)
        {
            //use return for the value

            return $result[$key];
        }

    }


//Display all heroes
    function showAll()
    {
        $str = "SELECT * FROM " .$this->tableName;
        $sth = ConnectDb::getInstance()->getConnection();

        $stm = $sth->prepare($str);
        $stm->execute();
        var_dump($stm->fetchAll(PDO::FETCH_ASSOC));

    }

//Some text for clarification would be nice.
    function setHealthDB($name,$newHealth)
    {
        $str = "UPDATE ".$this->tableName. " SET health = :newHealth WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newHealth' => $newHealth,':name' => $name];
        $stm =  $sth->prepare($str);
        $stm->execute($values);
    }


    function setStaminaDB($name,$newStamina)
    {
        $str = "UPDATE " .$this->tableName. " SET stamina = :newStamina WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newStamina' => $newStamina,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }
    function setXpDB($name,$newXp)
    {
        $str = "UPDATE " .$this->tableName. " SET xp = :newXp WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newXp' => $newXp,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);

    }

    function defaultStatsDB()
    {
        $this->setHealthDB("Aragorn",70);
        $this->setHealthDB("Orc",90);
        $this->setHealthDB("General",80);
        $this->setHealthDB("Tribe Leader",100);
        $this->setStaminaDB("Aragorn",60);
        $this->setStaminaDB("Orc",10);
        $this->setStaminaDB("General",30);
        $this->setStaminaDB("Tribe Leader",20);
    }

}

