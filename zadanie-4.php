<?php

$filePath = "test.txt";

function createFile($filePath)
{
    
    $content = "Пьер, самый рассеянный, забывчивый человек, теперь, по списку, составленному женой, купил все, не забыв ни комиссий матери и брата, ни подарков на платье Беловой, ни игрушек племянникам. Ему странно показалось в первое время своей женитьбы это требование жены — исполнить и не забыть всего того, что он взялся купить, и поразило серьезное огорчение ее, когда он в первую свою поездку все перезабыл. Но впоследствии он привык к этому. Зная, что Наташа для себя ничего не поручала, а для других поручала только тогда, когда он сам вызывался, он теперь находил неожиданное для самого себя детское удовольствие в этих покупках подарков для всего дома и ничего никогда не забывал. Ежели он заслуживал упреки от Наташи, то только за то, что покупал лишнее и слишком дорого. Ко всем своим недостаткам, по мнению большинства: неряшливости, опущенности, или качествам, по мнению Пьера, Наташа присоединяла еще и скупость.";

    if (!file_exists($filePath)) {
        $text = wordwrap($content, 150);
        file_put_contents($filePath, $text);
    }
}

function n1($fileContent)
{
    $newFile = "task1.txt";
    if (!file_exists($fileContent)) {
        createFile($fileContent);
        return n1($fileContent);
    } else {
        $content = file_get_contents($fileContent);
        if ($content) {
            file_put_contents($newFile, $content);
        }
    }
}

n1($filePath);

function n2($fileContent)
{
    $newFile = "task2.txt";
    if (!file_exists($fileContent)) {
        createFile($fileContent);
        return n2($fileContent);
    } else {
        $content = file_get_contents($fileContent);
        if ($content) {
            $content = preg_replace('/[уУеЕаАоОэЭяЯиИюЮыЫёЁ]+/u', '', $content);
            file_put_contents($newFile, $content);
        }
    }

}

n2($filePath);

function n3($fileContent)
{
    $newFile = "task3.txt";
    if (!file_exists($fileContent)) {
        createFile($fileContent);
        return n3($fileContent);
    } else {
        $file = fopen($fileContent, 'r');
        if($file) {
            $newContent = '';
            $i = 1;
            while(($str = fgets($file)) != false) {
                if ($i % 3) {
                    $newContent .= $str;
                }
                $i++;
            }
            file_put_contents($newFile, $newContent);
        }
    } 
}

n3($filePath);

function n4($fileContent)
{
    $newFile = "task4.txt";
    if (!file_exists($fileContent)) {
        createFile($fileContent);
        return n4($fileContent);
    } else {
        $content = file_get_contents($fileContent);
        if ($content) {
            $content = preg_replace_callback('/\b([а-яА-Я]+)\b/u', function($matches) {
                $text = mb_str_split($matches[0]);
                for ($i = 1; $i <= count($text); $i++) {
                    if ($i % 2) {
                        $text[$i-1] = '*';
                    }
                }
                return implode('', $text);
            }, $content);

            file_put_contents($newFile, $content);
        }
    }
}

n4($filePath);

function n5($fileContent)
{
    $newFile = "task5.txt";
    if (!file_exists($fileContent)) {
        createFile($fileContent);
        return n5($fileContent);
    } else {
        $content = file_get_contents($fileContent);
        if ($content) {
            $content = preg_replace_callback('/\b([а-яА-Я]+)\b/u', function($matches) {
                $text = $matches[0];
                $len = mb_strlen($text);
                if ($len <= 7 or $len >= 10) {
                    $text = '';
                }
                return $text;
            }, $content);
            $content = preg_replace('/(\W+|\s+)/u', ' ', $content);

            file_put_contents($newFile, $content);
        }
    }
}

n5($filePath);