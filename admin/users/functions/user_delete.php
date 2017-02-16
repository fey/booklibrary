<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
if (isset($_POST['action']) and $_POST['action'] == 'Удалить') {

    try {
        $sql = 'DELETE FROM user_roles WHERE userid = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e) {
        echo 'Ошибка при удалении книги из жанра' . $e->getMessage();
        exit();
    }

    // Удаление книги

    try {
        $sql = 'DELETE FROM user WHERE id = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e) {
        echo 'Ошибка при удалении книги' . $e->getMessage();
        exit();
    }

    header('Location: .');
    exit();


try {
    $sql = 'DELETE FROM user WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
}
catch (Exception $e)
{
    echo 'Ошибка при удалении пользователя' . $e->getMessage();
    exit();
}
header('Location: .');
exit();
}
