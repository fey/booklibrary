<?php include '../../includes/helpers.inc.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Управление книгами</title>
</head>
<body>
<h1>Управление книгами</h1>
<p><a href="..">На главную</a></p>
<p><a href="?add">Добавить новую книгу</a></p>

<form class="" action="index.html" method="get">
  <p>Вывести книги, удовлетворяющие критериям:</p>
  <div class="">
    <label for="author">По автору</label>
    <select class="" name="author" id="author">
      <option value="">Любой автор</option>
      <?php foreach($authors as $author): ?>
        <option value="<?php htmlout($author['id']) ?>">
          <?php htmlout($author['nameFirst']. " ". $author['nameLast']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="">
    <label for="author">По жанру</label>
    <select class="" name="author" id="author">
      <option value="">Любой жанр</option>
      <?php foreach($genres as $genre): ?>
        <option value="<?php htmlout($genre['id']) ?>">
          <?php htmlout($genre['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="">
    <label for="text">Содержит текст</label>
    <input type="text" name="text" id="text">

  </div>
  <div class="">
    <input type="hidden" name="action" value="search">
    <input type="submit"  value="Искать">

  </div>
</form>
</body>
</html>
