<?php
include '../../includes/db_connect.php';
include '../../includes/magicquotes.inc.php';

if (isset($_GET['add']))
 {
     $pageTitle = 'Новая книга';
     $action = 'addform';
     $name = '';
     $id = '';
     $button = 'Добавить книгу';

     try
     {
         $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
     }
     catch (Exception $e)
     {
         echo 'Ошибка извлечения авторов из базы данных!' . $e->getMessage();
         exit();
     }

     foreach ($result as $row)
     {
         $authors[] = array('id' => $row['id'], 'nameFirst' => $row['nameFirst'], 'nameLast' => $row['nameLast']);
     }

     try
     {
         $result = $pdo->query('SELECT id, name FROM genres');
     }
     catch (Exception $e)
     {
         echo 'Ошибка извлечения жанров из базы данных!' . $e->getMessage();
         exit();
     }
     foreach ($result as $row)
     {
         $genres[] = array(
           'id' => $row['id'],
           'name' => $row['name'],
           'selected' => FALSE);
     }

     include 'form.html.php';
     exit();
}

if(isset($_GET['addform']))
{
  include '../../includes/db_connect.php';

  if(empty($_POST['author']))
  {
    echo 'Автор должен быть выбран';
    exit();
  }

  try {
    $sql = 'INSERT INTO books SET
              bookName = :bookName,
              authorid = :authorid';
    $s = $pdo->prepare($sql);
    $s->bindValue(':bookName', $_POST['bookName']);
    $s->bindValue(':authorid', $_POST['author']);
    $s->execute();

  }
  catch (Exception $e) {
    echo 'Ошибка при отправке книги'
    . $e->getMessage();
    exit();
  }
  $bookid = $pdo->lastInsertId();
var_dump($bookid);
  if(isset($_POST['genres']))
  {
    try {
      $sql= 'INSERT INTO bookgenres SET
              bookid  = :bookid,
              genreid = :genreid';
              $s = $pdo->prepare($sql);

            foreach($_POST['genres'] as $genreid)
            {
              $s->bindValue(':bookid', $bookid);
              $s->bindValue(':genreid', $genreid);
              $s->execute();
            }
    } catch (Exception $e) {
      echo "Ошибка при добавлении книги в жанр" . $e->getMessage();
      exit();
    }

  }
  header('Location: .');
  exit();


}


if (isset($_POST['action']) and $_POST['action'] == 'Редактировать')

{
  try {
    $sql = 'SELECT id, bookName, authorid
            FROM books WHERE id = :id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':id', $_POST['id']);
            $s->execute();

  } catch (Exception $e) {
    echo 'Ошибка при информации о книге<br />' . $e->getMessage();
  }

  $row = $s->fetch();

  $pageTitle = 'Редактировать книгу';
  $action = 'editform';
  $bookName = $row['bookName'];
  $authorid = $row['authorid'];
  $id = $row['id'];
  $button = 'Обновить книгу';

  // Построить список авторов

  try
  {
      $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
  }
  catch (Exception $e)
  {
      echo 'Ошибка извлечения авторов из базы данных!' . $e->getMessage();
      exit();
  }

  foreach ($result as $row)
  {
      $authors[] = array('id' => $row['id'],
                  'nameFirst' => $row['nameFirst'],
                   'nameLast' => $row['nameLast']);
  }

  try {
    $sql = 'SELECT genreid FROM bookgenres WHERE bookid = :id';
    $s= $pdo->prepare($sql);
    $s->bindValue(':id', $id);
    $s->execute();
  } catch (Exception $e) {
    echo 'Ошибка получения выбранных жанров' . $e->getMessage();
    exit();
  }


  foreach($s as $row)
  {
    $selectedGenres[] = $row['genreid'];
  }
  // Строим список всех жанров

  try {
    $result = $pdo->query('SELECT id, name FROM genres');

  } catch (Exception $e) {
    echo 'Ошибка получения списка жанров' . $e->getMessage();
    exit();
  }

  foreach($result as $row)
  {
    $genres[] = array(
                  'id' => $row['id'],
                  'name' => $row['name'],
                  'selected' => in_array($row['id'], $selectedGenres));
  }

  include 'form.html.php';
  exit();
}


if(isset($_GET['editform']))
{

  if(empty($_POST['author']))
  {
    echo 'Вы должны выбрать автора ';
    exit();
  }
  try {
    $sql = 'UPDATE books SET
            bookName = :bookName,
            authorid = :authorid
            WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':bookName', $_POST['bookName']);
    $s->bindValue(':authorid', $_POST['author']);
    $s->execute();
} catch (Exception $e) {
echo 'Ошибка при редактировании книги' .$e->getMessage();
  }
  try {
    $sql = 'DELETE FROM bookgenres WHERE bookid = :id';
    $s   = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (Exception $e) {
    echo 'Ошибка изменения жанров книги';
    exit();
  }

  if(isset($_POST['genres']))
  {



    try {
          $sql = 'INSERT INTO bookgenres SET
          bookid = :bookid,
          genreid = :genreid';
          $s = $pdo->prepare($sql);

          foreach($_POST['genres'] as $genreid)
          {
            $s->bindValue(':bookid', $_POST['id']);
            $s->BindValue(':genreid', $genreid);
            $s->execute();

      }

    }
    catch (Exception $e) {
      echo 'Ошибка при добавлении книги в жанры' . $e->getMessage();
      foreach($_POST['genres'] as $genreid)
      {
        var_dump($_POST['id']);
        var_dump($genreid);
        echo '<hr />';
      }
      exit();

    }
  }

  header('Location: .');
  exit();

}

if (isset($_POST['action']) and$_POST['action'] == 'Удалить')
{

try
{
  $sql = 'DELETE FROM bookgenres WHERE bookid = :id';
  $s = $pdo->prepare($sql);
  $s->bindValue(':id', $_POST['id']);
  $s->execute();
}
catch (PDOException $e)
{
  echo 'Ошибка при удалении книги из жанра'. $e->getMessage();
  exit();
}

// Удаление книги

try
{
  $sql = 'DELETE FROM books WHERE id = :id';
  $s = $pdo->prepare($sql);
  $s->bindValue(':id', $_POST['id']);
  $s->execute();
}
catch (PDOException $e)
{
  echo 'Ошибка при удалении книги'
  . $e->getMessage();
  exit();
}

header('Location: .');
exit();

}


if(isset($_GET['action']) and $_GET['action'] === 'search')
{
  $select = 'SELECT id, bookName';
  $from = ' FROM books';
  $where = ' WHERE TRUE';

  $placeholders = array();


  if (($_GET['author'] != ''))
  {
    $where .= ' AND authorid = :authorid';
    $placeholders[':authorid'] = $_GET['author'];
  }
  if (($_GET['genre'] != ''))
  {
    $from .= ' INNER JOIN bookgenres ON id = bookid';
    $where .= ' AND genreid = :genreid';
    $placeholders[':genreid'] = $_GET['genre'];
  }

  if(($_GET['text'] != ''))
  {
    $where .= " AND bookName LIKE :bookName";
    $placeholders[':bookName'] = '%' . $_GET['text'] . '%';
  }

  try {
    $sql = $select . $from . $where;
    $s = $pdo->prepare($sql);
    $s->execute($placeholders);
  } catch (Exception $e) {
    echo 'Ошибка при получении шуток' . $e->getMessage();
    exit();
  }

  foreach($s as $row)
  {
  $books[] = array('id' => $row['id'], 'bookName' => $row['bookName']);
  }

  include 'books.html.php';
  exit();
}

// Показать форму поиска

try {
  $result = $pdo->query('SELECT id, nameFirst, nameLast FROM author');
} catch (Exception $e) {
  echo 'Ошибка при получении авторов' . $e->getMessage();
  exit();
}

foreach ($result as $row)
{
  $authors[] = array('id' => $row ['id'],
                     'nameFirst' => $row ['nameFirst'],
                     'nameLast' => $row ['nameLast']);
}

try {
  $result = $pdo->query('SELECT id, name FROM genres');
}
catch (Exception $e)
  {
  echo 'Ошибка при извлечении жанров' . $e->getMessage();
  exit();
}

foreach ($result as $row)
{
  $genres[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'searchform.html.php';
