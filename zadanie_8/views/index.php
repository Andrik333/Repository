<?php

use src\Components;

$this->title = 'Главная';

?>

<?php if (count($news) != 0) { ?>
    <?php foreach($news as $new) { ?>
        <article class="article-news style-block">
            <div class="header">
                <h2 class="title"><?= Components::getValue($new, 'title') ?></h2>
                <span class="date">Дата: <?= Components::formatDate(Components::getValue($new, 'date_create')) ?></span>
            </div>
            <p class="text"><?= mb_substr(Components::getValue($new, 'text'), 0, 100) ?>...</p>
            <div class="footer">
                <span class="autor" title="<?= Components::getValue($new, 'autor.login') ?>">Автор: 
                    <?php $autor = Components::getValue($new, 'autor.login'); 
                    echo (mb_strlen($autor) > 10 ? mb_substr($autor, 0, 10) . '...' : $autor); ?>
                </span>
                <a class="link-new-read button" href="news?id=<?= Components::getValue($new, 'id') ?>">Читать далее...</a>
            </div>
        </article>
    <?php } ?>
<?php } else { ?>
    <article class="article-news style-block">Новостей нет</article>
<?php } ?>