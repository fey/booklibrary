<?php
function userIsLoggedIn()
{
  require_once $_SERVER['DOCUMENT_ROOT'] . '/bookstore/includes/db_connect.php';
  if (isset($_POST['action']) and $_POST['action'] == 'login') {
      if (!isset($_POST['name']) or $_POST['password'] == '' or !isset($_POST['password']) or $_POST['password'] == '') {
      $GLOBALS['loginError'] = 'Пожалуйста,заполните оба поля';
      return FALSE;
      }
    $password = md5($_POST['password'] . 'fey');

    if (dbContainsUser($_POST['name'], $password)) {
      session_start();
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['name'] = $_POST['name'];
      $_SESSION['password'] = $password;
      return TRUE;
      }
    else {
      session_start();
      unset($_SESSION['loggedIn']);
      unset($_SESSION['name']);
      unset($_SESSION['password']);
      $GLOBALS['loginError'] = 'Указан неверный логин или пароль';
     }


    }

  if(isset($_POST['action']) and $_POST['action'] == 'logout') {
    session_start();
    unset($_SESSION['loggedIn']);
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    header("Location: {$_POST['goto']}");
    exit();
    }
  session_start();
  if (isset($_SESSION['loggedIn'])) {
    return dbContainsUser($_SESSION['name'], $_SESSION['password']);
  }
}
