<?php


class HeroRepository extends Commands
{
    public function __construct()
    {
        parent::__construct('characters');
    }
    function addXpToHeroDB($name,$xp)
    {
        $str = "UPDATE ".$this->getTableName()." SET xp = :newXp WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name,':newXp' => $xp];
        $stm =  $sth->prepare($str);
        $stm->execute($values);
    }
    function defaultStatsDB()
    {
        $this->setHealthDB("Aeneas",70);
        $this->setHealthDB("Orc",90);
        $this->setHealthDB("General",60);
        $this->setHealthDB("Tribe Leader",70);
        $this->setStaminaDB("Aeneas",60);
        $this->setStaminaDB("Orc",10);
        $this->setStaminaDB("General",10);
        $this->setStaminaDB("Tribe Leader",10);
        $this->setXpDB("Aeneas",0);
        $this->setXpDB("Orc",0);
        $this->setHealthDB("Eldritch Horror",150);
        $this->setStaminaDB("Eldritch Horror",30);

    }
    function setHealthDB($name,$newHealth)
    {
        $str = "UPDATE ".$this->getTableName(). " SET health = :newHealth WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newHealth' => $newHealth,':name' => $name];
        $stm =  $sth->prepare($str);
        $stm->execute($values);
    }


    function setStaminaDB($name,$newStamina)
    {
        $str = "UPDATE " .$this->getTableName(). " SET stamina = :newStamina WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newStamina' => $newStamina,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
    }
    function setXpDB($name,$newXp)
    {
        $str = "UPDATE " .$this->getTableName(). " SET xp = :newXp WHERE Name = :name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':newXp' => $newXp,':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);

    }
    function showXpDB($name)
    {
        $str = "SELECT xp FROM " .$this->getTableName(). " WHERE Name=:name";
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
    //Must use return statement when used in game logic!
    function showStamina($name)
    {
        $str = "SELECT stamina FROM " .$this->getTableName(). " WHERE Name=:name";
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
    function showDamage($name)
    {
        $str = "SELECT damage FROM " .$this->getTableName(). " WHERE Name=:name";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':name' => $name];
        $stm = $sth->prepare($str);
        $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ((array) $result as $key=>$value)
        {
            return (int)$result[$key];
        }
    }
    function showName($id)
    {
        $str = "SELECT name FROM " .$this->getTableName(). " WHERE id=:id";
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

    function showHealth($name)
    {
        $str ="SELECT health FROM " .$this->getTableName(). " WHERE name=:name";

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

    function getIdByName($name)
    {
        $str = "SELECT id FROM " .$this->getTableName(). " WHERE name=:$name";
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




}