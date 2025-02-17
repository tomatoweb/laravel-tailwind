<?php
$path = __DIR__.DIRECTORY_SEPARATOR.'test.txt';
file_put_contents($path, ' Hello World!', FILE_APPEND);

echo file_get_contents($path);

// $posts = file_get_contents('http://jsonplaceholder.typicode.com/posts'); // !! do not use file_get_contents for url fetch

// echo file_put_contents($path, $posts, FILE_APPEND);

// echo file_get_contents($path);
