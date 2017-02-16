<?php
function userHasRole($role)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
    try {

        $sql = 'SELECT COUNT(*) FROM user
        INNER JOIN user_roles ON user.id = userid
        INNER JOIN role ON roleid = role.id
        WHERE name = :name AND role.id = :roleid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_SESSION['name']);
        $s->bindValue(':roleid', $role);
        $s->execute;

    } catch (Exception $e) {
        echo 'Ошибка при получении ролей, назначенных автору' . $e->getMessage();
        exit();
    }

    $row = $s->fetch();

    if($row[0] > 0) {
        return true;
    }
    return false;
}
