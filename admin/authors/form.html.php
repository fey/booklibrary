

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/helpers.inc.php' ?>
    <title><?php htmlout($pageTitle) ?></title>
</head>
<body>
    <h1>
      <?php htmlout($pageTitle); ?>
    </h1>
    <a href="..">back</a>
    <form class="" action="?<?php htmlout($action) ?>" method="post">
        <div>
            <label for="nameFirst"><p>Имя:</p> <input type="text" name="nameFirst" id="nameFirst" value="<?php htmlout($nameFirst) ?>"></label>
        </div>
        <div>
            <label for="nameLast"><p>Фамилия:</p>
              <input type="text" name="nameLast" id="nameLast" value="<?php htmlout($nameLast) ?>">
            </label>
        </div>
        <div class="">
            <input type="hidden" name="id" value="<?php htmlout($id) ?>">
            <input type="submit" value="<?php htmlout($button) ?>">
        </div>
    </form>
</body>
</html>
