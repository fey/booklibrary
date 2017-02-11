<?php
if (isset($_POST['action']) and $_POST['action'] === 'Удалить')
{
//получаем книги, принадлежащие автору    # code...
    try
    {
        $sql = 'SELECT id FROM books WHERE authorid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (Exception $e)
    {
        echo 'Ошибка при получении списка книг для удаления' .$e->getMessage();
        exit();
    }
    $result = $s->fetchAll();
    // Удаляем записи о жанрах книг.
    try
    {
        $sql = 'DELETE FROM bookgenres WHERE bookid = :id';
        $s = $pdo->prepare($sql);
        // Для каждой книги
        foreach ($result as $row)
        {
            $bookid = $row['id'];
            $s->bindValue(':id', $bookid);
            $s->execute();
        }
    }
    catch (Exception $e)
    {
    echo 'Ошибка при удалении жанров книги' . $e->getMessage();
    exit();
    }



    try
    {
        $sql = 'DELETE FROM books WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        echo 'Ошибка при удалении книг' . $e->getMessage();
        exit();
    }
    // Удаляем автора
    try {
        $sql = 'DELETE FROM author WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (Exception $e)
    {
        echo 'Ошибка при удалении автора' . $e->getMessage();
        exit();
    }
    header('Location: .');
    exit();

}
