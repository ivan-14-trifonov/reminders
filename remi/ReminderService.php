<?php

/**
 * Сервис для управления списком напоминаний
 */
class ReminderService
{
    /** 
     * @var Reminder[] Все напоминания из БД
     */
    private $allReminders = [];

    // конструктор
    public function __construct()
    {
        global $db;
        // Считываем все напоминания в массив AllReminders
        $response = $db->query("SELECT * FROM `reminder`")->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($response); $i++) {
            $this->allReminders[] = new Reminder($response[$i]);
        }
    }
    
    /**
     * Возвращает все имеющиеся напоминания в виде масссива объектов Reminder
     * @return Reminder[]
     */
    public function getAllReminders()
    {
        return $this->allReminders;
    }
    
    /**
     * Возвращает напоминание с id $idReminder
     * @return Reminder
     */
    public function getReminder($idReminder)
    {
        return $this->allReminders[$idReminder - 1];
    }
    
    /**
     * Отправляет напоминания
     */
    public function sendReminders()
    {
        // время в минутах, секунды обрезаем
        $timeDivider = 60;
        
        $allRemi = $this->getAllReminders();
        $time = floor(time() / $timeDivider);
        for ($i = 0; $i < count($allRemi); $i++) {
            $remiTime = floor(strtotime($allRemi[$i]->timeGet()) / $timeDivider);
            // берём только те напоминания, дата и время которых уже наступили
            if ($remiTime <= $time) {
                $period = floor($allRemi[$i]->periodGet() / $timeDivider);
                // сразу отправляем те, время которых совпадает
                if ($remiTime == $time) {
                    $allRemi[$i]->toSend();
                }
                // теперь отправляем повторные
                elseif (($allRemi[$i]->periodGet() != 0) && (($time - $remiTime) % $period == 0)) {
                    $allRemi[$i]->toSend();
                }
            }
        }
    }

}