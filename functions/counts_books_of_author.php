<?php
try {
  $sql = 'SELECT author.nameFirst, author.nameLast, count(books.id) as sumBooks
            FROM author LEFT JOIN books
            ON authorid = author.id
            GROUP BY author.id
            ORDER BY sumBooks DESC';
$result = $pdo->query($sql);
} catch (Exception $e) {
  echo 'Ошибка при получении счетчика книг' .$e->getMessage();
}
foreach ($result as $row) {
  $bookCounts[] = array(
    'nameFirst'=> $row['nameFirst'],
    'nameLast' => $row['nameLast'],
    'sumbooks' => $row['sumBooks']
  );
}
