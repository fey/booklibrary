
<!DOCTYPE html>
<html lang="en">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/helpers.inc.php' ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление жанрами</title>
</head>

<body>
    <h1>Управление жанрами</h1>
    <a href="../">Назад</a>
    <p><a href="?add">Добавить новый жанр</a></p>
    <ul>
        <?php foreach($genres as $genre): ?>
        <li>
            <form action="" method="post">
            <div>
                <p><?php htmlout($genre['name']) ?></p>

                <input type="hidden" name="id" value="<?= $genre['id'] ?>">
                <input type="submit" name="action" value="Редактировать">
                <input type="submit" name="action" value="Удалить">
            </div>
            </form>
        </li>

        </div>
        </form>
        </li>
        <?php endforeach; ?>
    </ul>

    </ul>
</body>

</html>
