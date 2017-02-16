<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
if (isset($_GET['add']))
 {
     $pageTitle = 'Новый жанр';
     $action = 'addform';
     $name = '';
     $id = '';
     $button = 'Добавить жанр';

     include 'html/form.html.php';
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
