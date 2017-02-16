<?php
try {
    $sql = 'SELECT books.id, bookName, nameFirst, nameLast FROM books
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
