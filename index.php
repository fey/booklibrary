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
    nameFirst = :nameFirst,
    nameLast = :nameLast,
    readDate = :readDate';
        $s = $pdo->prepare($sql);
        $s->bindValue(':bookName', $_POST['bookName']);
        $s->bindValue(':nameLast', $_POST['nameLast']);
        $s->bindValue(':nameLast', $_POST['nameLast']);
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
    $sql = 'SELECT
              books.id, bookName, nameFirst, nameLast
            FROM books
            INNER JOIN author
            ON authorid = author.id';
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    echo $error = 'Error fetching books'.$e->getMessage();
    exit();
}

foreach ($result as $row) { // мы получили массив массивов,
                            // теперь каждая книга - массив
    $book[] = array('id' => $row['id'],
              'bookName' => $row['bookName'],
              'nameFirst'=> $row['nameFirst'],
              'nameLast' => $row['nameLast'],
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
