<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
if (isset($_GET['add']))
 {
     $pageTitle = 'Новый автор';
     $action = 'addform';
     $nameFirst = '';
     $nameLast = '';
     $id = '';
     $button = 'Добавить автора';

     include 'html/form.html.php';
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
