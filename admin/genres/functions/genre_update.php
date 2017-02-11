<?php
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
    $genre= $s->fetch();

    $pageTitle = 'Редактировать жанр';
    $action    = 'editform';
    $button    = 'Обновить жанр';

    include 'html/form.html.php';
    exit();

}
if (isset($_GET['editform']))
{
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
