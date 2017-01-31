<?php
try {
    $sql = 'CREATE TABLE books (
            id         INT   NOT NULL AUTO_INCREMENT PRIMARY KEY,
            bookName   TEXT  NOT NULL,
            authorName TEXT  NOT NULL,
            readDate   DATE  NOT NULL)
            DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';
    $pdo->exec($sql);
} catch (PDOException $exception) {
    $output = 'Ошибка создания таблицы books <br />'.
    $exception->getMessage();
    echo $output;
    exit();
}
$output = 'Таблица books успешно создана <br />';
echo $output;
