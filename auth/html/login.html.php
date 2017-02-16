<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/helpers.inc.php' ?>
  <title>Вход</title>
</head>
<body>
  <h1>Вход</h1>
  <?php if(isset($loginError)): ?>
  <?php htmlout($loginError) ?>
  <?php endif ?>
  <a href="..">Назад</a>
  <form class="" action="" method="post">
    <input type="hidden" name="id">
    <label for="">
      <p>Имя пользователя</p>
      <input type="text" name="name" placeholder="Login" autocomplete="off">
    </label><label for="">
      <p>Пароль:</p>
      <input type="password" name="password" placeholder="Password" autocomplete="off">
      <p>
        <input type="hidden" name="action" value="login">
        <input type="submit" name="submit" value="Войти">
      </p>
    </label>
  </form>


</body>
</html>
