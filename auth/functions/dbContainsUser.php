<?php
function dbContainsUser($name, $password)
{
  require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
  try {

    $sql = 'SELECT COUNT(*) FROM user
    WHERE name = :name AND password = :password';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $name);
    $s->bindValue(':password', $password);
    $s->execute();

  } catch (PDOException $e) {
    echo 'Ошибка при поиске пользователя' . $e->getMessage();
    exit();
  }
  $user = $s->fetch();
  if($user[0] > 0)
  {
    return TRUE;
  }
    return FALSE;

}
