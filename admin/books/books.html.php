<?php include '../../includes/helpers.inc.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Управление книгами: результаты поиска</title>
</head>
<body>
  <h1>Результат поиска:</h1>
  <p><a href="?">Искать заново</a></p>
  <p><a href="..">Назад</a></p>
  <?php if(isset($books)): ?>
    <table>
      <tr>
        <th>Название книги</th>
        <th>Действия</th>
      </tr>
      <?php foreach($books as $book): ?>
      <tr>
        <td><?php htmlout($book['text']) ?></td>
        <td>
          <form class="" action="?" method="post">
            <div class="">
              <input type="hidden" name="id" value="<?php htmlout($book['id']) ?>">
              <input type="submit" name="action" value="Редактировать">
              <input type="submit" name="action" value="Удалить">
            </div>
          </form>
        </td>

      </tr>
    <?php endforeach; ?>
    </table>
  <?php endif; ?>
</body>
</html>
