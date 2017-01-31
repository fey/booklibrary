<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>books</title>
</head>

<body>
    <div class="books_list">
        <h2>All books:</h2>
        <p><a href="?addNewBook">New Book</a>
<table>
    <?php if(isset($book)) foreach ($book as $book): ?>
<tr>
    <div class="book_example">
        <form action="?deleteBook" method="post">
            <p>
                <!-- выводим элементы массива Книга без id -->
                <? foreach(array_slice($book, 1) as $bookAttributes): ?>
                <?= $bookAttributes ?>
                <? endforeach ?>
            </p>
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <input type="submit" value="Удалить">

    </form>
    </div>
    <hr>
    <?php endforeach ?>
    </tr>
</table>
    </div>
</body>

</html>
