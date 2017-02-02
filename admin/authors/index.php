<?php
include '../../includes/db_connect.php';
include '../../includes/magicquotes.inc.php';
////// Добавить нового автора
if (isset($_GET['add']))
 {
     $pageTitle = 'Новый автор';
     $action = 'addform';
     $nameFirst = '';
     $nameLast = '';
     $id = '';
     $button = 'Добавить автора';

     include 'form.html.php';
     exit();
}

if (isset($_GET['addform']))
{
    try {
        $sql = 'INSERT INTO author SET
       nameFirst = :nameFirst,
       nameLast = :nameLast';
        $s = $pdo->prepare($sql);
        $s->bindValue(':nameFirst', $_POST['nameFirst']);
        $s->bindValue(':nameLast', $_POST['nameLast']);
        $s->execute();

    }
    catch (Exception $e)
    {
        echo 'Ошибка при добавлении автора' . $e->getMessage();
        exit();
    }
    header('Location: .');
    exit();
}
/////// Редактирование автора
if (isset($_POST['action']) and $_POST['action'] === 'Редактировать')
{
    try {
        $sql = 'SELECT id, nameFirst, nameLast FROM author WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (Exception $e) {
        echo 'Ошибка при получении автора' . $e->getMessage();
        exit();
    }
    $row= $s->fetch();

    $pageTitle = 'Редактировать автора';
    $action    = 'editform';
    $nameFirst = $row['nameFirst'];
    $nameLast  = $row['nameLast'];
    $id        = $row['id'];
    $button    = 'Обновить информацию об авторе';
    include 'form.html.php';
    exit();

}

if (isset($_GET['editform']))
{
  include '../../includes/db_connect.php';

  try
  {
    $sql = 'UPDATE author SET
       nameFirst = :nameFirst,
       nameLast = :nameLast
       WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':nameFirst', $_POST['nameFirst']);
    $s->bindValue(':nameLast', $_POST['nameLast']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    echo $error = 'Error updating submitted author.'
    . $e->getMessage();
    exit();
  }

  header('Location: .');
  exit();
}

////// Удаление
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
    try {
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



// Вывод списка авторов
try
{
    $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
}
catch (Exception $e)
{
    echo 'Ошибка извлечения авторов из базы данных!' . $e->getMessage();
    exit();
}

foreach ($result as $row)
{
    $authors[] = array('id' => $row['id'], 'nameFirst' => $row['nameFirst'], 'nameLast' => $row['nameLast']);
}

include 'authors.html.php';
