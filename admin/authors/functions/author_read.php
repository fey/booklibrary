<?php
  try {
      $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
  }
  catch (Exception $e) {
      echo 'Ошибка извлечения авторов из базы данных!' . $e->getMessage();
      exit();
  }

  foreach ($result as $row) {
      $authors[] = array(
          'id'        => $row['id'],
          'nameFirst' => $row['nameFirst'],
          'nameLast'  => $row['nameLast']
      );
  }
