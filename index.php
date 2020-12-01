<?php

require_once __DIR__ . '/scr/View/head.php';
require_once __DIR__ . '/scr/mainPoint.php';

if (!empty($_GET['text'])){
    $mainPoint = new MainPoint($_GET['text'], $_GET['keyWords']);
    $mainPoint->getAllResume();
}

require_once __DIR__ . '/scr/View/bottom.php';