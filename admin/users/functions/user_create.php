<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
if (isset($_GET['add'])) {
    $pageTitle = 'Новый пользователь';
    $action    = 'addform';
    $name      = '';
    $id        = '';
    $button    = 'Добавить автора';
    include 'includes/fetchRolesTable.php';
    include 'html/form.html.php';
    exit();

    try {
        $result = $pdo->query('SELECT id, description FROM role');

    }
    catch (Exception $e) {
        echo 'Ошибка получения списка ролей' . $e->getMessage();
        exit();
    }

    foreach ($result as $row) {
        $roles[] = array(
            'id' => $row['id'],
            'description' => $row['description'],
            'selected'    => false
        );
    }
    include '../html/form.html.php';
}

if (isset($_GET['addform'])) {
    try {
        $sql = 'INSERT INTO user SET
              name = :name';
        $s   = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->execute();
    }
    catch (Exception $e) {
        echo 'Ошибка при отправке книги' . $e->getMessage();
        exit();
    }

    $userid = $pdo->lastInsertId();

    if (($_POST['password']) != "") {
        $password = md5($_POST['password'] . 'fey');
        try {
            $sql = 'UPDATE user SET
              password  = :password
              WHERE id  = :id';
              $s   = $pdo->prepare($sql);
              $s->bindValue(':id', $userid);
              $s->bindValue(':password', $password);
              $s->execute();
        }
        catch (Exception $e) {
            echo "Ошибка при назначении пароля пользователю" . $e->getMessage();
            exit();
        }

    }

    if(isset($_POST['roles'])) {
        foreach ($_POST['roles'] as $role) {
            try {
                $sql = 'INSERT INTO user_roles SET
                userid = :userid,
                roleid = :roleid';
                $s   = $pdo->prepare($sql);
                $s->bindValue(':userid', $userid);
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
