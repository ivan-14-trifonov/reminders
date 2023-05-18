<?php

// Инициализируем приложение
require_once __DIR__ . '/../bootstrap.php';

if ($_POST["change"] == "") {

    // Вызываем вид, чтобы отобразить список напоминаний
    require_once __DIR__ . '/../view/remi.phtml';
}

if ($_POST["change"] == "add") {
    
    $arrayOfFields = array(
        "text" => $_POST["text"],
        "time" => $_POST["date"]." ".$_POST["time"],
        "period" => $_POST["period"],
    );
    
    $ch = new Change($arrayOfFields);
    $ch->addRemiToDB();
    
    reminderService();
}

if ($_POST["change"] == "edit") {
    
    $arrayOfFields = array(
        "id" => $_POST["id"],
        "text" => $_POST["text"],
        "time" => $_POST["date"]." ".$_POST["time"],
        "period" => $_POST["period"],
    );
    
    $ch = new Change($arrayOfFields);
    $ch->editRemiToDB();
    
    reminderService();
}

if ($_POST["change"] == "delete") {
    
    $arrayOfFields = array(
        "id" => $_POST["id"],
    );
    
    $ch = new Change($arrayOfFields);
    $ch->deleteRemiToDB();
    
    reminderService();
}

function reminderService() {

    // Отображаем список напоминаний
    $reminderService = new ReminderService;
    $listOfReminders = $reminderService->getAllReminders();
    
    $html = '<div class="reminder button-add">
                <p class="reminder__str plus">+</p>
                <p class="reminder__str create">Создать напоминание</p>
            </div>';
    
    for ($i = 0; $i < count($listOfReminders); $i++) {
        $reminder = $listOfReminders[$i];
        $html = $html.'<div class="reminder" name='.$reminder->idGet().'>
                <p class="reminder__str text" name="text_'.$reminder->idGet().'">'.$reminder->textGet().'</p>
                <p class="reminder__str time" name="time_'.$reminder->idGet().'">'.$reminder->timeGet().'</p>
                <div class="reminder__str">
                    <p class="reminder__repeat" name="repeat_'.$reminder->idGet().'" value='.$reminder->periodGet().'>';
                    
        if ($reminder->periodGet() != 0) {
            $html = $html.'<sup>'.round($reminder->periodGet()/86400, 3).'</sup>
            <img class="reminder__img" src="/../remi/view/images/repeat.png">';
        };
            
        $html = $html.'</p>
                    <p class="reminder__edit button-edit" value='.$reminder->idGet().'><img class="reminder__img" src="/../remi/view/images/edit.png"></p>
                    <p class="reminder__delete button-delete" value='.$reminder->idGet().'><img class="reminder__img" src="/../remi/view/images/delete.png"></p>
                </div>
            </div>';

    }
    
    $html = $html.'<script src="/../remi/view/js/popUpWindow.js"></script>
                   <script src="/../remi/view/js/change.js"></script>';
    
    echo $html;
};