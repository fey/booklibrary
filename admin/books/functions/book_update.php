<?php
if (isset($_POST['action']) and $_POST['action'] == 'Редактировать') {
    try {
        $sql = 'SELECT id, bookName, authorid
            FROM books WHERE id = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();

    }
    catch (Exception $e) {
        echo 'Ошибка при информации о книге<br />' . $e->getMessage();
    }

    $row = $s->fetch();

    $pageTitle = 'Редактировать книгу';
    $action    = 'editform';
    $bookName  = $row['bookName'];
    $authorid  = $row['authorid'];
    $id        = $row['id'];
    $button    = 'Обновить книгу';

    // Построить список авторов
    include 'includes/fetchAuthorTable.php';

    try {
        $sql = 'SELECT genreid FROM bookgenres WHERE bookid = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка получения выбранных жанров' . $e->getMessage();
        exit();
    }


    foreach ($s as $row) {
        $selectedGenres[] = $row['genreid'];
    }
    // Строим список всех жанров

    try {
        $result = $pdo->query('SELECT id, name FROM genres');

    }
    catch (Exception $e) {
        echo 'Ошибка получения списка жанров' . $e->getMessage();
        exit();
    }

    foreach ($result as $row) {
        $genres[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'selected' => in_array($row['id'], $selectedGenres)
        );
    }

    include 'html/form.html.php';
    exit();
}


if (isset($_GET['editform'])) {

    if (empty($_POST['author'])) {
        echo 'Вы должны выбрать автора ';
        exit();
    }
    try {
        $sql = 'UPDATE books SET
            bookName = :bookName,
            authorid = :authorid
            WHERE id = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':bookName', $_POST['bookName']);
        $s->bindValue(':authorid', $_POST['author']);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка при редактировании книги' . $e->getMessage();
    }
    try {
        $sql = 'DELETE FROM bookgenres WHERE bookid = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка изменения жанров книги';
        exit();
    }

    if (isset($_POST['genres'])) {



        try {
            $sql = 'INSERT INTO bookgenres SET
          bookid = :bookid,
          genreid = :genreid';
            $s   = $pdo->prepare($sql);

            foreach ($_POST['genres'] as $genreid) {
                $s->bindValue(':bookid', $_POST['id']);
                $s->BindValue(':genreid', $genreid);
                $s->execute();

            }

        }
        catch (Exception $e) {
            echo 'Ошибка при добавлении книги в жанры' . $e->getMessage();
            foreach ($_POST['genres'] as $genreid) {
                var_dump($_POST['id']);
                var_dump($genreid);
                echo '<hr />';
            }
            exit();

        }
    }

    header('Location: .');
    exit();

}
