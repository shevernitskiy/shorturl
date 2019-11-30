<?php

$data = ['url' => [
    'https://web.whatsapp.com/',
    'http://95.165.98.14/addlink.php'
    ]
];

$result = file_get_contents('http://localhost/scripts/urlshortener/shorter.php', false, stream_context_create([
    'http' => [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
    ]
]));

echo $result;
