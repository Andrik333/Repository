<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="asset/js.js"></script>
        <link rel="stylesheet" type="text/css" href="asset/style.css">
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="alert">
            <span class="title"></span>
            <span class="message"></span>
        </div>
        <header>
            <nav class="header-content">
                <div>
                    <a class="button" href="index">Главная</a>
                    <?php if ($this->user->is_aut()): ?>
                        <a class="button" href="create-news">Добавить новость</a>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if ($this->user->is_aut()): ?>
                        <?php $login = $this->user->login; ?>
                        <span title="<?= $login ?>">
                            <?= 'Пользователь ' . (mb_strlen($login) > 10 ? mb_substr($login, 0, 10) . '...' : $login) ?>
                        </span>
                        <a class="button" href="logout">Выход</a>
                    <?php else: ?>
                        <a class="button" href="login">Войти</a>
                    <?php endif; ?>
                </div>
            </nav>
        </header>
        <div class="content">
            <?= $content ?>
        </div>
        <footer>
        </footer>
    </body>
</html>
