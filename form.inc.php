<form name="addNewBook" class="form" action="?" method="post">
    <fieldset>
        <h2>Введите данные книги</h2>
        <p>Название книги</p>
        <input type="text" name="bookName" value="Название книги">
        <br>
        <p>Имя автора</p>
        <input type="text" name="nameFirst" value="nameFirst">
        <input type="text" name="NameLast" value="nameFirst">
        <p>Дата прочтения</p>
        <input type="date" name="readDate" value="<?= date('Y-m-d') ?>">
    </fieldset>
    <fieldset>
        <input type="reset" name="reset" value="Сброс">
        <input type="submit" name="submit" value="Отправить">

    </fieldset>
</form>
