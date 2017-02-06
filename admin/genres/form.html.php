<?php include $_SERVER['DOCUMENT_ROOT']
. '/bookstore/includes/helpers.inc.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php htmlout($pageTitle) ?></title>
</head>
<body>
    <h1>
      <?php htmlout($pageTitle); ?>
    </h1>
    <form class="" action="?<?php htmlout($action) ?>" method="post">
      <div>
        <label for="name">Название:
          <input id="name" type="text" name="name" value="<?php htmlout($name);?> ">
        </label>
      </div>
      <div class="">
            <input type="hidden" name="id" value="<?php htmlout($id) ?>">
            <input type="submit" value="<?php htmlout($button) ?>">
        </div>
    </form>
</body>
</html>
