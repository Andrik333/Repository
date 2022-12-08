<?php

use src\Components;

$this->title = 'Новость: ' . Components::getValue($new, 'title');

?>

<article class="article-news style-block">
    <div class="header">
        <h2 class="title"><?= Components::getValue($new, 'title') ?></h2>
        <span class="date">Дата: <?= Components::formatDate(Components::getValue($new, 'date_create')) ?></span>
    </div>
    <p class="text"><?= Components::getValue($new, 'text') ?></p>
    <div class="footer">
        <span class="autor">Автор: <?= Components::getValue($new, 'autor.login') ?></span>
        <?php if (Components::getValue($new, 'autor.id') == $this->user->id): ?>
            <a class="button" href="news-remove?id=<?= Components::getValue($new, 'id') ?>">Удалить</a>
        <?php endif; ?>
    </div>
</article>
<?php if ($this->user->is_aut()): ?>
<div class="add-comments style-block">
    <h3>Добавить комментарий</h3>
    <form id="add-comment-form" action="add-comment-news?id=<?= Components::getValue($new, 'id') ?>" method="post">
        <div class="block-form input">
            <textarea rows="5" type="text" name="comment" required></textarea>
        </div>
        <div class="block-form">
            <button class="button" type="submit">Отправить</button>
        </div>
    </form>
</div>
<?php endif; ?>
<?= Components::createComments($new->comments) ?>
