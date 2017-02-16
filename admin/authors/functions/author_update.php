<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
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
    $author= $s->fetch();

    $pageTitle = 'Редактировать автора';
    $action    = 'editform';
    $button    = 'Обновить информацию об авторе';

    include 'html/form.html.php';
    exit();
}


if (isset($_GET['editform']))
{
  try
  {
    $sql = 'UPDATE author SET nameFirst = :nameFirst, nameLast = :nameLast
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
