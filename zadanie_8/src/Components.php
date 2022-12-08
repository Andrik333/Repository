<?php

namespace src;

class Components
{
    public static function formatDate(string $date = 'now', string $format = 'Y.m.d H:i') : string
    {
        return (new \DateTime($date))->format($format);
    }

    public static function dateDB(string $date = 'now') : string
    {
        return (new \DateTime($date))->format('Y-m-d H:i:s');
    }

    public static function getValue($value, string $levels = null, $returnIsNull = null)
    {
        if ($levels) {
            $levels = explode('.', $levels);

            foreach ($levels as $level) {
                if (is_object($value)) {
                    $value = isset($value->$level) ? $value->$level : $returnIsNull;
                } else if (is_array($value)) {
                    $value = isset($value[$level]) ? $value[$level] : $returnIsNull;
                }
            }
        } else {
            $value = isset($value) ? $value : $returnIsNull;
        }

        return $value;
    }

    public static function createComments(array $comments)
    {
        $html = '<div class="comments style-block">
                    <h3>Комментарии</h3>';
        if (count($comments) != 0) {
            foreach($comments as $comment) {
                $html .= '
                <div class="comment style-block">
                    <div class="comment-head">
                        <span class="comment-autor">Автор: ' . self::getValue($comment, 'autor.login') . '</span>
                        <span class="comment-date">Дата: ' . self::formatDate(self::getValue($comment, 'date_create')) . '</span>
                    </div>
                    <p class="comment-text">' . self::getValue($comment, 'comment') . '</p>
                    <div class="comment-footer">
                        <button class="button" data-comment=\'' . json_encode(['comment' => self::getValue($comment, 'id'), 'news' => self::getValue($comment, 'new')]) . '\' onclick="removeComment(this)">Удалить</button>
                    </div>
                </div>
                ';
            }
        } else {
            $html .= '<div class="comment style-block">Комментариев нет</div>';
        }

        $html .= '</div>';

        return $html;
    }

    public static function createNews(array $news)
    {
        $html = '';
        if (count($news) != 0) {
            foreach($news as $new) {
                $text = self::getValue($new, 'text');
                $autor = self::getValue($new, 'autor.login');

                if (mb_strlen($text) > 100) {
                    $text = mb_substr(self::getValue($new, 'text'), 0, 100) . '...';
                }

                if (mb_strlen($autor) > 100) {
                    $autor = mb_substr(self::getValue($autor, 'text'), 0, 100) . '...';
                }

                $html .= '
                    <article class="article-news style-block">
                        <div class="header">
                            <h2 class="title">' . self::getValue($new, 'title') . '</h2>
                            <span class="date">Дата: ' . self::formatDate(self::getValue($new, 'date_create')) . '</span>
                        </div>
                        <p class="text">' . $text .'</p>
                        <div class="footer">
                            <span class="autor" title="' . self::getValue($new, 'autor.login') . '">Автор: ' . $autor . ' </span>
                            <a class="link-new-read button" href="news?id=' . self::getValue($new, 'id') . '">Читать далее...</a>
                        </div>
                    </article>
                ';
            }
        } else {
            $html .= '<article class="article-news style-block">Новостей нет</article>';
        }

        return $html;
    }
}
