<?php
if (isset($_POST['action']) and $_POST['action'] === 'Удалить')
{
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
