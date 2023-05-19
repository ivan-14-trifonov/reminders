<?php

// Инициализируем приложение
require_once __DIR__ . '/../bootstrap.php';

// Подключаем файл, содержащий вид для одного напоминания
require_once __DIR__ . '/../view/displaysRemi.php';

// Инициализируем список напоминаний
$reminderService = new ReminderService;
$listOfReminders = $reminderService->getAllReminders();

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
    
    // Обновляем список напоминаний
    $reminderService = new ReminderService;
    $listOfReminders = $reminderService->getAllReminders();
    // Отображаем список напоминаний
    displaysRemi($listOfReminders);
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
    
    // Обновляем список напоминаний
    $reminderService = new ReminderService;
    $listOfReminders = $reminderService->getAllReminders();
    // Отображаем список напоминаний
    displaysRemi($listOfReminders);
}

if ($_POST["change"] == "delete") {
    
    $arrayOfFields = array(
        "id" => $_POST["id"],
    );
    
    $ch = new Change($arrayOfFields);
    $ch->deleteRemiToDB();
    
    // Обновляем список напоминаний
    $reminderService = new ReminderService;
    $listOfReminders = $reminderService->getAllReminders();
    // Отображаем список напоминаний
    displaysRemi($listOfReminders);
}