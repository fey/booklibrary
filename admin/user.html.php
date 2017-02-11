<?php
include '../includes/db_connect.php';
try
{
    $result = $pdo->query('SELECT id, name, password FROM user');
}
catch (Exception $e)
{
    echo 'Ошибка извлечения пользователей!' . $e->getMessage();
    exit();
}

foreach ($result as $row)
{
    $users[] = array('id' => $row['id'], 'name' => $row['name'], 'password' => $row['password']);
}
?>
<table>
  <thead>
    <th>id</th>
    <th>name</th>
    <th>password</th>
  </thead>
  <?php foreach($users as $user): ?>
    <tr>
      <?php foreach($user as $field): ?>
      <td><?= $field ?></td>
    <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
</table>
