<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Список пользователей</title>
</head>
<body>
  <h1>Список пользователей</h1>
  <p><a href="?add">Добавить нового пользователя</a></p>
  <a href="..">Назад</a>
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
      <td>
          <form action="" method="post">
          <div>
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
              <input type="submit" name="action" value="Редактировать">
              <input type="submit" name="action" value="Удалить">
          </div>
          </form>
      </td>
      </tr>
    <?php endforeach; ?>
  </table>

</body>
</html>
