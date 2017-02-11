<?php
if (isset($_POST['action']) and $_POST['action'] == 'Удалить') {

    try {
        $sql = 'DELETE FROM bookgenres WHERE bookid = :id';
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
        $sql = 'DELETE FROM books WHERE id = :id';
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

}
