<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Reminder.php';
require_once __DIR__ . '/ReminderService.php';
require_once __DIR__ . '/Change.php';

// Подключение к БД
try {
    $db = new PDO('mysql:host='.$pdoconfig['host'].';dbname='.$pdoconfig['dbname'], $pdoconfig['username'], $pdoconfig['password']);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}