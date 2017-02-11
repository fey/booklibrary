<?php
if (isset($_GET['new'])) {
  $action = 'newuser';
  $page['title'] = "Новый пользователь";

  $button = "Регистрация";

  include 'form.html';
  exit();
}
if (isset($_GET['newuser'])) {
  include '../includes/db_connect.php';
  $user['name'] = $_POST['name'];
  $user['password'] = md5(md5($_POST['password']) . 'fey');

    try {
        $sql = 'INSERT INTO user SET
       name = :name,
       password = :password';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $user['name']);
        $s->bindValue(':password', $user['password']);
        $s->execute();

    }
    catch (Exception $e)
    {
        echo 'Ошибка при добавлении пользователя' . $e->getMessage();
        exit();
    }
    header('Location: ..');
    exit();
}



/*
 Регистрация
 */
if(isset($_POST['login']) and isset($_POST['password']))
{
}

// echo '$_REQUEST';
// var_dump($_REQUEST);
// echo '$_GET';
// var_dump($_GET);
// echo '$_POST';
// var_dump($_POST);
