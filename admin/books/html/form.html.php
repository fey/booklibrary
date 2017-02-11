<?php include '../../includes/helpers.inc.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php htmlout($pageTitle) ?></title>
</head>
<body>
  <h1><?php htmlout($pageTitle) ?></h1>
  <a href="..">назад</a>
<form action="?<?php htmlout($action) ?>" method="post">
  <div class="">
    <label for="text">Введите название книги:</label>
    <input type="text" id="text" name="bookName" value="<?php htmlout($bookName); ?>">
    <div class="">
      <label for="author">Выбрать автора:</label>
      <select name="author" id="author">
        <option value="">Выбрать</option>
        <?php foreach($authors as $author): ?>
          <option value="<?php htmlout($author['id']) ?>"
            <?php if($author['id'] == $authorid) htmlout("selected")?>>
          <?php htmlout($author['nameFirst']. " ". $author['nameLast']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <fieldset>
      <legend>Жанры:</legend>
      <?php foreach($genres as $genre): ?>
        <div class="">
          <label for="genre<?php htmlout($genre['id']); ?>">
            <input type="checkbox" name="genres[]" id="genre<?php htmlout($genre['id']); ?>" value="<?php htmlout($genre['id']); ?>"
            <?php if($genre['selected']) echo ' checked';
            ?>>
          <?php htmlout($genre['name']) ?></label>

        </div>
      <?php endforeach; ?>
    </fieldset>
  </div>
  <input type="hidden" name="id" value="<?php htmlout($id); ?>">
  <input type="reset" name="" value="reset">
  <input type="submit" name="" value="submit">
</form>
</body>
</html>
