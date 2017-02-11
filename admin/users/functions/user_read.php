<?php
try
{
    $result = $pdo->query('SELECT id, name, password FROM user');
}
catch (Exception $e)
{
    echo 'Ошибка извлечения пользователей!' . $e->getMessage();
    exit();
}

foreach ($result as $row)
{
    $users[] = array('id' => $row['id'], 'name' => $row['name'], 'password' => $row['password']);
}
