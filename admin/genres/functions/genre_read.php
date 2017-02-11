<?php
    try {
      include ($_SERVER['DOCUMENT_ROOT'].'/bookstore/includes/db_connect.php');
      $result = $pdo->query('SELECT id, name FROM genres');
  }
  catch (Exception $e) {
      echo 'Ошибка извлечения жанров из базы данных!' . $e->getMessage();
      exit();
  }
  foreach ($result as $row) {
      $genres[] = array(
          'id' => $row['id'],
          'name' => $row['name'],
          'selected' => FALSE
      );
  }
