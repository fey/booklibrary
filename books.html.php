<!DOCTYPE html>
<html>
<?php include_once 'includes/helpers.inc.php' ?>
<head>
    <meta charset="utf-8">
    <title>books</title>
</head>

<body>
    <div class="books_list">
        <h2>All books:</h2>
<table>
    <?php if(isset($book)) foreach ($book as $book): ?>
<tr>
    <div class="book_example">
        <form action="" method="get">
            <p>
                <? htmlout($book['bookName']) ?>
                penned by
                <i><? htmlout($book['nameFirst']." ". $book['nameLast'])?></i>
            </p>
            <input type="hidden" name="id" value="<?= htmlout($book['id']) ?>">

    </form>
    </div>
    <hr>
    <?php endforeach ?>
    </tr>
</table>
    </div>

</body>

</html>
