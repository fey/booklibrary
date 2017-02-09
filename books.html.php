<!DOCTYPE html>
<html>
<?php include_once 'includes/helpers.inc.php' ?>
<head>
    <meta charset="utf-8">
    <title>books</title>
    <style media="screen">
    .content {
      display:flex;
    }
      .books_count {
        display:block;
        width:350px;
        margin-right: 0px;
        margin-left: auto;
      }
      .books_count td:nth-child(2) {
        text-align: right;
      }
      .books_count tr:nth-child(even) {
        background-color: #eee;
      }
    </style>
</head>

<body>

    <div class="content">
      <div class="books_list">
          <h2>All books:</h2>
          <a href="admin/">admin</a>
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
      <div class="books_count">
        <table>
          <tr>
            <th>Имя автора</th>
            <th>Количество книг</th>
          </tr>
            <?php foreach($bookCounts as $author): ?>
              <tr>
                <td> <?php htmlout($author['nameFirst']) ?> <?php htmlout($author['nameLast']) ?> </td>
                <td> <?php htmlout($author['sumbooks']) ?> </td>
              </tr>
            <?php endforeach; ?>
        </table>

      </div>
    </div>
</body>

</html>
