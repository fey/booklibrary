<?php
if (isset($_POST['action']) and $_POST['action'] == 'Редактировать') {
    try {
        $sql = 'SELECT id, name, password
            FROM user WHERE id = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();

    }
    catch (Exception $e) {
        echo 'Ошибка при информации о юзере<br />' . $e->getMessage();
    }

    $row = $s->fetch();

    $pageTitle = 'Редактировать юзера';
    $action    = 'editform';
    $bookName  = $row['name'];
    $authorid  = $row['password'];
    $id        = $row['id'];
    $button    = 'Обновить книгу';

    // Построить список авторов
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

    try {
        $sql = 'SELECT roleid FROM user_roles WHERE userid = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка получения выбранных жанров' . $e->getMessage();
        exit();
    }


    foreach ($s as $row) {
        $selectedroles[] = $row['roleid'];
    }
    // Строим список всех жанров

    try {
        $result = $pdo->query('SELECT id, description FROM role');

    }
    catch (Exception $e) {
        echo 'Ошибка получения списка жанров' . $e->getMessage();
        exit();
    }

    foreach ($result as $row) {
        $roles[] = array(
            'id' => $row['id'],
            'description' => $row['description'],
            'selected' => in_array($row['id'], $selectedroles)
        );
    }

    include 'html/form.html.php';
    exit();
}


if (isset($_GET['editform'])) {
    try {
        $sql = 'UPDATE user SET
            name = :name
            WHERE id = :id';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':name', $_POST['name']);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка при редактировании пользователя' . $e->getMessage();
    }

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password'] . 'fey');
        try {
            $sql = 'UPDATE user SET
              password  = :password
              WHERE id  = :id';
              $s   = $pdo->prepare($sql);
              $s->bindValue(':id', $authorid);
              $s->bindValue(':password', $password);
              $s->execute();
        }
        catch (Exception $e) {
            echo "Ошибка при назначении пароля пользователю" . $e->getMessage();
            exit();
        }

    }
    try {
        $sql = 'DELETE FROM user_roles WHERE userid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (Exception $e) {
        echo 'Ошибка при удалении неактуальных ролей'
        . $e->getMessage();
    }

    if(isset($_POST['roles'])) {
        foreach ($_POST['roles'] as $role) {
            try {
                $sql = 'INSERT INTO user_roles SET
                userid = :userid,
                roleid = :roleid';
                $s   = $pdo->prepare($sql);
                $s->bindValue(':userid', $_POST['id']);
                $s->bindValue(':roleid', $role);
                $s->execute();

            } catch (Exception $e) {
                echo "Ошибка при назначении ролей пользователю" . $e->getMessage();
                exit();
            }
         }
    }
    header('Location: .');
    exit();

}
