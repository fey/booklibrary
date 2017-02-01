<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
try {
    $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
}
catch (Exception $e) {
    echo 'Ошибка извлечения авторов из базы данных!' . $e->getMessage();
    exit();
}

foreach ($result as $row) {
    $authors[] = array(
        'id' => $row['id'],
        'nameFirst' => $row['nameFirst'],
        'nameLast' => $row['nameLast']
    );
}

////// Удаление авторов и их книг
if (isset($_POST['action']) and $_POST['action'] === 'Удалить') {
    include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
    // Получаем книги автора.
    try {
        $sql = 'SELECT id FROM books WHERE authorid = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e) {
        echo 'Ошибка при получении книг, которые нужно удалить'
        . $e->getMessage();
    }
    $result = $s->fetchAll();
    // Удаляем записи о жанрах книги
    try {
        $sql = 'DELETE FROM bookgenres WHERE bookid = :id';
        $s   = $pdo->prepare($sql);
        foreach ($result as $row) {
            $bookid = $row['id'];
            $s->bindValue(':id', $bookid);
            $s->execute();
        }
    }
    catch (Exception $e) {
        echo 'Ошибка при удалении жанров' . $e->getMessage();
        exit();
    }
    // Удаляем книги, принадлежащие автору
    try {
        $sql = 'DELETE FROM books WHERE authorid = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (Exception $e) {
        echo 'Ошибка при удалении книг, принадлежащих автору'
        . $e->getMessage();
        exit();

    }

    // Удаляем автора
    try {
        $sql = 'DELETE FROM author WHERE id = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка при удалении автора' . $e->getMessage();
        exit();
    }
    header('Location: .');
    exit();

}
include 'authors.html.php';
