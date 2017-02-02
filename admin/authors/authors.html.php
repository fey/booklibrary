
<!DOCTYPE html>
<html lang="en">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/helpers.inc.php' ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление авторами</title>
</head>

<body>
    <h1>Управление авторами</h1>
    <p><a href="?add">Добавить нового автора</a></p>
    <ul>
        <?php foreach($authors as $author): ?>
        <li>
            <form action="" method="post">
            <div>
                <?php htmlout($author['nameFirst'] . " " . $author['nameLast']) ?>

                <input type="hidden" name="id" value="<?= $author['id'] ?>">
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
