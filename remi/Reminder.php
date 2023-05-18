<?php

/**
 * Модель напоминания
 */
class Reminder
{
    // Идентификатор напоминания
    private $id;
    
    // Текст напоминания
    private $text;
    
    // Время напоминания
    private $time;
    
    // Период напоминания
    private $period;
    
	// конструктор
    public function __construct($arrayOfFields)
    {
        $this->id = $arrayOfFields['id'];
        $this->text = $arrayOfFields['text'];
        $this->time = $arrayOfFields['time'];
        $this->period = $arrayOfFields['period'];
    }
    
    // чтение поля id
    public function idGet()
    {
        return($this->id);
    }

    // чтение поля text
    public function textGet()
    {
        return($this->text);
    }
    
    // чтение поля time
    public function timeGet()
    {
        return($this->time);
    }
    
    // чтение поля period
    public function periodGet()
    {
        return($this->period);
    }
    
    // чтение всех полей класса
    public function allGet() 
    {
        return [
            "id" => $this->id,
            "text" => $this->text,
            "time" => $this->time,
            "period" => $this->period,
            ];
    }
    
    // перезапись всех полей класса
    public function allSet($arrOfFields) 
    {
        $this->id = $arrOfFields["id"];
        $this->text = $arrOfFields["text"];
        $this->time = $arrOfFields["time"];
        $this->period = $arrOfFields["period"];
    }
    
    // отправить напоминание
    public function toSend()
    {
        // отправка сообщения
        global $botconfig;
        
        $getQuery = array(
            "chat_id" 	=> $botconfig['chat_id'],
            "text"  	=> $this->textGet(),
            "parse_mode" => "html"
            );
            
        $ch = curl_init("https://api.telegram.org/bot". $botconfig['token'] ."/sendMessage?" . http_build_query($getQuery));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $resultQuery = curl_exec($ch); // на этой строке происходит отправка сообщения
        curl_close($ch);
    }
    
    // добавить напоминание в БД
    public function addToDB(){
        print('начало');
        global $db;
        $request = "INSERT INTO `reminder`(`text`, `time`, `period`) VALUES ('".$this->text."','".$this->time."',".$this->period.");";
        $response = $db->query($request);
    }
	
}