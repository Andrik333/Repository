<?php

$this->title = 'Авторизация';
?>

<form id="login-form" class="style-block" action="" method="post">
    <div class="block-form input">
        <label for="login">Логин</label>
        <input type="text" name="login" required>
    </div>
    <div class="block-form input">
        <label for="password">Пароль</label>
        <input type="password" name="password" required>
    </div>
    <div class="block-form">
        <button class="button" type="submit">Вход</button>
        <a class="button" href="registration">Регистрация</a>
    </div>
</form>
