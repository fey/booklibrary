<?php
include '../../includes/db_connect.php';
include '../../includes/magicquotes.inc.php';
// Добавление жанра
include 'functions/genre_create.php';

////// Редактирование
include 'functions/genre_update.php';
////// Удаление
include 'functions/genre_delete.php';
include 'functions/genre_read.php';

include 'html/genres.html.php';
