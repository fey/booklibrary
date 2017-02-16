<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
if (isset($_GET['add'])) {
    $pageTitle = 'Новая книга';
    $action    = 'addform';
    $name      = '';
    $id        = '';
    $button    = 'Добавить книгу';
    include 'includes/fetchAuthorTable.php';
    include 'includes/fetchGenresTable.php';
    include 'html/form.html.php';
    exit();
}

if (isset($_GET['addform'])) {
    if (empty($_POST['author'])) {
        echo 'Автор должен быть выбран';
        exit();
    }
    try {
        $sql = 'INSERT INTO books SET
              bookName = :bookName,
              authorid = :authorid';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':bookName', $_POST['bookName']);
        $s->bindValue(':authorid', $_POST['author']);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка при отправке книги' . $e->getMessage();
        exit();
    }

    $bookid = $pdo->lastInsertId();
    if (isset($_POST['genres'])) {
        try {
            $sql = 'INSERT INTO bookgenres SET
              bookid  = :bookid,
              genreid = :genreid';
            $s   = $pdo->prepare($sql);

            foreach ($_POST['genres'] as $genreid) {
                $s->bindValue(':bookid', $bookid);
                $s->bindValue(':genreid', $genreid);
                $s->execute();
            }
        }
        catch (Exception $e) {
            echo "Ошибка при добавлении книги в жанр" . $e->getMessage();
            exit();
        }

    }
    header('Location: .');
    exit();


}
