<?php

require 'functions/get_magic_quotes_gpc.php';
require 'pdo/db_connect.php';

//
if (isset($_GET['addNewBook'])) {
    include 'form.inc.php';
    exit();
}

if (isset($_POST['bookName'])) {
    try {
        $sql = 'INSERT INTO books set
    bookName = :bookName,
    authorName = :authorName,
    readDate = :readDate';
        $s = $pdo->prepare($sql);
        $s->bindValue(':bookName', $_POST['bookName']);
        $s->bindValue(':authorName', $_POST['authorName']);
        $s->bindValue(':readDate', $_POST['readDate']);
        $s->execute();
    } catch (PDOException $e) {
        echo $error = 'Error adding submitted book:'.$e->getMessage();
        exit();
    }
    header('Location: .');
    exit();
}
///////////////////////////////////////////////////
///////////////////////////////////////////////////
try {
    $sql = 'SELECT id, bookName, authorName, readDate FROM books';
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    echo $error = 'Error fetching books'.$e->getMessage();
    exit();
}

foreach ($result as $row) { // мы получили массив массивов,
                            // теперь каждая книга - массив
    $book[] = array('id' => $row['id'],
                      'bookName' => $row['bookName'],
                      'authorName' => $row['authorName'],
                      'readDate' => $row['readDate'],
                  );
}

/////////////////////////////////////////////////
/////////////////// УДАЛЕНИЕ КНИГИ
if (isset($_GET['deleteBook'])) {
    try {
        $sql = 'DELETE FROM books WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (Exception $e) {
        echo 'Ошибка при удалении книги'.$e->getMessage();
        exit();
    }
    header('Location: .');
}
//////////////////////////////////////////
include 'books.html.php';
