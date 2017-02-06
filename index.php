<?php
include 'includes/magicquotes.inc.php';
include 'includes/db_connect.php';
//
if (isset($_GET['addNewBook'])) {
    include 'form.inc.php';
    exit();
}

if (isset($_POST['bookName'])) {
    include 'includes/db_connect.php';
    try {
        $sql = 'INSERT INTO books set
                  bookName = :bookName,
                  authorid = :authorid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':bookName', $_POST['bookName']);
        $s->bindValue(':authorid', $_POST['authorid']);
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
    $book[] = array(
              'id' => $row['id'],
              'bookName' => $row['bookName'],
              'nameFirst'=> $row['nameFirst'],
              'nameLast' => $row['nameLast'],
          );
}
include 'books.html.php';
