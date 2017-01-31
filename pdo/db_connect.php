<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bookstore',
                   'root', // Имя пользователя
                   'mysql' // Пароль пользователя
                  );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
} catch (PDOException $e) {
    echo $output = 'Невозможно подключиться к серверу баз данных. <br />'.$e->getMessage();
    exit();
}
echo 'Соединение установлено <br />';
