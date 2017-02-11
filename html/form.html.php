

<form name="addNewBook" class="form" action="?" method="post">
    <fieldset>
        <h2>Введите данные книги</h2>
        <p>Название книги</p>
        <input type="text" name="bookName" value="Название книги">
        <br>
        <p>Имя автора</p>
        <select class="" name="">
          <?php foreach($authors as $author): ?>
            <option value="<?php htmlout($author['id'])?>"><?php htmlout($author['nameFirst']) ?></option>
          <?php endforeach; ?>
        </select>
    </fieldset>
    <fieldset>
        <input type="reset" name="reset" value="Сброс">
        <input type="submit" name="submit" value="Отправить">

    </fieldset>
</form>
