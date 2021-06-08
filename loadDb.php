<?php

require_once 'db.php';

function getDataFromUrl($url)
{
    // Некие проблемы под windows
    // @see https://stackoverflow.com/questions/61635366/openssl-error-messages-error14095126-unexpected-eof-while-reading
    error_reporting(0);
    try {
        $content = file_get_contents($url);
    } catch (Exception $e) {
        echo 'Data unavailable';
        exit(1);
    }

    return $content;
}

function insertToDb($connection, $name, $columns, $values)
{
    $sql = "INSERT INTO `{$name}`({$columns}) VALUES {$values}";
    $connection->exec($sql);
}

if (null === $dbcon) {
    exit(1);
}

$content = getDataFromUrl('https://jsonplaceholder.typicode.com/posts');
$columns = '`userId`, `id`, `title`, `body`';
$data = json_decode($content, true);
$values = '';
$cntPost = 0;
foreach ($data as $row) {
    $values .= '(' . $row['userId'] . ',' . $row['id'] . ',"' . $row['title'] . '","' . $row['body'] . '"),';
    $cntPost++;
}

// Удалим последнюю запятую.
$values = substr($values, 0, -1);

insertToDb($dbcon, 'POST', $columns, $values);

$content = getDataFromUrl('https://jsonplaceholder.typicode.com/comments');
$columns = '`postId`, `id`, `name`, `email`, `body`';
$data = json_decode($content, true);
$values = '';
$cntComment = 0;
foreach ($data as $row) {
    $values .= '(' . $row['postId'] . ',' . $row['id'] . ',"' . $row['name'] . '","'
        . $row['email'] . '","' . $row['body'] . '"),';
    $cntComment++;
}

$values = substr($values, 0, -1);

insertToDb($dbcon, 'COMMENT', $columns, $values);

echo "Загружено {$cntPost} записей и {$cntComment} комментариев" . PHP_EOL;
