<?php

const FILE_STORAGE = 'storage.json';

empty($_GET['url']) ?: $longurl[0] = $_GET['url'];

if (!empty($_POST['url'])) {
    if (is_string($_POST['url'])) {
        $longurl[0] = $_POST['url'];
    } elseif (is_array($_POST['url'])) {
        $longurl = $_POST['url'];
    }
}

if (empty($longurl)) {
    die('error');
}

$response = [];
$array = [];
if (file_exists(FILE_STORAGE)) {
    $array = json_decode(file_get_contents(FILE_STORAGE), true);
}

foreach ($longurl as $url) {
    $shorturl = base_convert(crc32($url), 20, 36);
    $array[$shorturl] = $url;
    $response[] = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/' . $shorturl;
}

file_put_contents(FILE_STORAGE, json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

if (count($response) > 1) {
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} else {
    echo $response[0];
}
