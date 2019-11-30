<?php

const FILE_STORAGE = 'storage.json';

empty($_GET['url']) ?: $longurl = $_GET['url'];
empty($_POST['url']) ?: $longurl = $_POST['url'];

if (empty($longurl)) {
    die('error');
}

$shorturl = base_convert(crc32($longurl), 20, 36);

if (file_exists(FILE_STORAGE)) {
    $array = json_decode(file_get_contents(FILE_STORAGE), true);
    $array[$shorturl] = $longurl;
    file_put_contents(FILE_STORAGE, json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
} else {
    file_put_contents(FILE_STORAGE, json_encode([$shorturl => $longurl], JSON_PRETTY_PRINT| JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

echo((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/' . $shorturl;
