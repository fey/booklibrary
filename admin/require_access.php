<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bookstore/auth/auth.php';
if (!userIsLoggedIn()) {
  include $_SERVER['DOCUMENT_ROOT'] .  '/bookstore/auth/html/login.html.php';
  exit();
}
