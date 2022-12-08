<?php

$this->title = 'Регистрация';

?>

<form id="registration-form" class="style-block" action="" method="post">
    <div class="block-form input">
        <label for="name">Имя</label>
        <input type="text" minlength="3" name="name" required>
    </div>
    <div class="block-form input">
        <label for="last_name">Фамилия</label>
        <input type="text" minlength="3" name="last_name" required>
    </div>
    <div class="block-form input">
        <label for="age">Возраст</label>
        <input type="number" minlength="1" name="age" required>
    </div>
    <div class="block-form input">
        <label for="phone">Телефон</label>
        <input type="text" minlength="11" name="phone" required>
    </div>
    <div class="block-form input">
        <label for="login">Логин</label>
        <input type="text" minlength="3" name="login" required>
    </div>
    <div class="block-form input">
        <label for="password">Пароль</label>
        <input type="password" minlength="5" name="password" required>
    </div>
    <div class="block-form input">
        <label for="passwordRepeat">Повтор пароля</label>
        <input type="password" minlength="5" name="passwordRepeat" required>
    </div>
    <div class="block-form">
        <button class="button" type="submit">Зарегистрироваться</button>
    </div>
</form>