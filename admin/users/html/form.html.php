<?php include $_SERVER['DOCUMENT_ROOT']
. '/bookstore/includes/helpers.inc.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление пользователями</title>
</head>
<body>
    <form class="" action="?<?php htmlout($action) ?>" method="post">
        <div class="">
            <label for="name">Имя:
                <input type="text" name="name" id="name" value="<?php htmlout($name) ?>">
            </label>
        </div>
        <div class="">
            <label for="password">Задать пароль:
                <input type="password" name="password" id="password">
            </label>
        </div>
        <fieldset>
            <legend> Roles: </legend>
            <?php for ($i=0; $i < count($roles); $i++): ?>
                <div class="">
                    <label for="role<?= $i ?>">
                        <input
                        type="checkbox"
                        name="roles[]"
                        id="role<?= $i ?>"
                        value="<?php htmlout($roles[$i]['id']) ?>"
                        <?php if ($roles[$i]['selected']) echo ' checked'; ?>>
                        <?php htmlout($roles[$i]['id']) ?>
                    </label>
                    <?php htmlout($roles[$i]['description']) ?>
                </div>
            <?php endfor ?>
        </fieldset>
        <div class="">
            <input type="hidden" name="id" value="<?php htmlout($id) ?>">
            <input type="submit" value="<?php htmlout($button) ?>">
        </div>
    </form>
</body>
</html>
