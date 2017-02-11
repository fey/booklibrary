<?php
require_once '../../includes/db_connect.php';
include '../../includes/magicquotes.inc.php';
////// Добавить нового автора
include 'functions/author_create.php';
/////// Редактирование автора
include 'functions/author_update.php';
////// Удаление
include 'functions/author_delete.php';
// Вывод списка авторов
include 'functions/author_read.php';


include 'html/authors.html.php';
