<?php

/**
 * Выполнение изменений
 */
class Change
{
    // массив полей
    private $arrayOfFields;
    
    // конструктор
    public function __construct($arrayOfFields)
    {
        $this->arrayOfFields = $arrayOfFields;
    }
    
    // добавить напоминание в БД
    public function addRemiToDB(){
        global $db;
        $request = "INSERT INTO `reminder`(`text`, `time`, `period`) VALUES ('".$this->arrayOfFields["text"]."','".$this->arrayOfFields["time"]."',".$this->arrayOfFields["period"].");";
        $response = $db->query($request);
    }
    
    // изменить напоминание в БД
    public function editRemiToDB(){
        global $db;
        $request = "UPDATE `reminder` SET `text`='".$this->arrayOfFields["text"]."',`time`='".$this->arrayOfFields["time"]."',`period`=".$this->arrayOfFields["period"]." WHERE `id`=".$this->arrayOfFields["id"].";";
        $response = $db->query($request);
    }
    
    // удалить напоминание в БД
    public function deleteRemiToDB(){
        global $db;
        $request = "DELETE FROM `reminder` WHERE `id`=".$this->arrayOfFields["id"].";";
        $response = $db->query($request);
    }
    
}