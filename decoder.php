<?php

const FILE_STORAGE = 'storage.json';

if (empty($_GET['url'])) {
    die('Empty url');
}

if (file_exists(FILE_STORAGE)) {
    $array = json_decode(file_get_contents(FILE_STORAGE), true);
    if (!empty($array[$_GET['url']])) {
        echo $array[$_GET['url']];
        header('location:'.$array[$_GET['url']]);        // редирект при доступе через веб
    } else {
        echo 'Decoder: Url not found';
    }
} else {
    echo 'Storage does not exists';
}
