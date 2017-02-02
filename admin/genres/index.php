<?php
include '../../includes/db_connect.php';
include '../../includes/magicquotes.inc.php';
// Добавление жанра
if (isset($_GET['add']))
 {
     $pageTitle = 'Новый жанр';
     $action = 'addform';
     $name = '';
     $id = '';
     $button = 'Добавить жанр';

     include 'form.html.php';
     exit();
}
if (isset($_GET['addform']))
{
  include '../../includes/db_connect.php';
    try {
        $sql = 'INSERT INTO genres
                SET name = :name';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->execute();

    }
    catch (Exception $e)
    {
        echo 'Ошибка при добавлении жанра' . $e->getMessage();
        exit();
    }
    header('Location: .');
    exit();
}

////// Редактирование
if (isset($_POST['action']) and $_POST['action'] === 'Редактировать')
{
    include '../../includes/db_connect.php';
    try {
        $sql = 'SELECT id, name FROM genres WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (Exception $e) {
        echo 'Ошибка при получении жанра' . $e->getMessage();
        exit();
    }
    $row= $s->fetch();

    $pageTitle = 'Редактировать жанр';
    $action    = 'editform';
    $name      = $row['name'];
    $id        = $row['id'];
    $button    = 'Обновить жанр';

    include 'form.html.php';
    exit();

}

if (isset($_GET['editform']))
{
  include '../../includes/db_connect.php';

  try
  {
    $sql = 'UPDATE genres SET
       name = :name
       WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':name', $_POST['name']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    echo $error = 'Ошибка при обновлении жанра.'
    . $e->getMessage();
    exit();
  }

  header('Location: .');
  exit();
}

////// Удаление
if (isset($_POST['action']) and $_POST['action'] === 'Удалить')
{
    include '../../includes/db_connect.php';
    try // Удаляем жанры,в которые входит книга
    {
        $sql = 'SELECT id FROM bookgenres WHERE genreid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch (Exception $e)
    {
        echo 'Ошибка при получении списка книг для удаления' .$e->getMessage();
        exit();
    }

    // Удаляем жанр
    try {
      $sql = 'DELETE FROM genres WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':id', $_POST['id']);
      $s->execute();
    } catch (Exception $e) {
      echo 'Ошибка при удалении жанра' .$e->getMessage();
      exit();
    }
    header('Location: .');
    exit();

}

try
{
    $result = $pdo->query('SELECT id, name FROM genres');
}
catch (Exception $e)
{
    echo 'Ошибка извлечения жанров из базы данных!' . $e->getMessage();
    exit();
}

foreach ($result as $row)
{
    $genres[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'genres.html.php';



// Удаление жанра
