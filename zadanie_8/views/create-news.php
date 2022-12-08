<?php

$this->title = 'Добавление новости';

?>

<form id="create-news-form" class="style-block" action="" method="post">
    <div class="block-form input">
        <label for="title">Заголовок</label>
        <input type="text" name="title" required>
    </div>
    <div class="block-form input">
        <label for="text">Содержание</label>
        <textarea rows="15" type="text" name="text" required></textarea>
    </div>
    <div class="block-form">
        <button class="button" type="submit">Сохранить</button>
    </div>
</form>
