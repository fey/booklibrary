<?php
function fetchGenresTable(){
    try {
      include ($_SERVER['DOCUMENT_ROOT'].'/bookstore/includes/db_connect.php');
      $result = $pdo->query('SELECT id, description FROM role');
  }
  catch (Exception $e) {
      echo 'Ошибка извлечения ролей из базы данных!' . $e->getMessage();
      exit();
  }
  foreach ($result as $row) {
      $roles[] = array(
          'id' => $row['id'],
          'description' => $row['description'],
          'selected' => FALSE
      );
  }
  return $roles;
}

$roles = fetchGenresTable();
