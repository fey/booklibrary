<?php
if (isset($_GET['action']) and $_GET['action'] === 'search') {
    $select = 'SELECT id, bookName';
    $from   = ' FROM books';
    $where  = ' WHERE TRUE';

    $placeholders = array();


    if (($_GET['author'] != '')) {
        $where .= ' AND authorid = :authorid';
        $placeholders[':authorid'] = $_GET['author'];
    }
    if (($_GET['genre'] != '')) {
        $from .= ' INNER JOIN bookgenres ON id = bookid';
        $where .= ' AND genreid = :genreid';
        $placeholders[':genreid'] = $_GET['genre'];
    }

    if (($_GET['text'] != '')) {
        $where .= " AND bookName LIKE :bookName";
        $placeholders[':bookName'] = '%' . $_GET['text'] . '%';
    }

    try {
        $sql = $select . $from . $where;
        $s   = $pdo->prepare($sql);
        $s->execute($placeholders);
    }
    catch (Exception $e) {
        echo 'Ошибка при получении шуток' . $e->getMessage();
        exit();
    }

    foreach ($s as $row) {
        $books[] = array(
            'id' => $row['id'],
            'bookName' => $row['bookName']
        );
    }

    include 'html/books.html.php';
    exit();
}

// Показать форму поиска

try {
    $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
}
catch (Exception $e) {
    echo 'Ошибка при получении авторов' . $e->getMessage();
    exit();
}

foreach ($result as $row) {
    $authors[] = array(
        'id' => $row['id'],
        'nameFirst' => $row['nameFirst'],
        'nameLast' => $row['nameLast']
    );
}

try {
    $result = $pdo->query('SELECT id, name FROM genres');
}
catch (Exception $e) {
    echo 'Ошибка при извлечении жанров' . $e->getMessage();
    exit();
}

foreach ($result as $row) {
    $genres[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}
