<?php

// Инициализируем приложение
require __DIR__ . '/../bootstrap.php';
$reminderService = new ReminderService;

// Отправляем напоминания
$reminderService->sendReminders();