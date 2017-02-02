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













if(isset($_GET['action']) and $_GET['action'] === 'search')
{
  $select = 'SELECT id, bookName';
  $from = 'FROM books';
  $where = 'WHERE TRUE';

  $placeholders = array();
  if ($_GET['author'] != '')
  {
    $where .= ' AND authorid = :authorid';
    $placeholders[':authorid'] = $_GET['authorid'];
  }
  if ($_GET['genre'] != '')
  {
    $from .= ' INNER JOIN bookgenres ON id = bookid';
    $where .= ' AND genreid = :genreid';
    $placeholders[':genreid'] = $_GET['genre'];
  }

  if($_GET['text'] != '')
  {
    $where .= " AND bookName LIKE :bookName";
    $placeholders[':bookName'] = '%' . $_GET['text'] . '%';
  }



}
include 'searchform.html.php';
