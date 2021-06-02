<?php

abstract class Commands
{
    public $sth;
    private $tableName;
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
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
        $str = "SELECT * FROM " .$this->tableName. " WHERE id=:id";
        $sth = ConnectDb::getInstance()->getConnection();
        $values = [':id' => $id];
        $stm = $sth->prepare($str);
       $stm->execute($values);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;

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


    function getTableName()
    {
        return $this->tableName;
    }

}

