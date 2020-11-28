<?php
$uri = $_SERVER['REQUEST_URI'];
require_once __DIR__.'/react-intro/build/index.html';
require_once __DIR__.'/scr/curl.php';

?>
	<!-- Load React. -->
	<!-- Note: when deploying, replace "development.js" with "production.min.js". -->
	<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
	<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<?php


/*if($uri === '/')
    require './s/index.html';*/

/*elseif($uri === '/find')
    require 'pages/about.php';
else
    require 'pages/error404.php';*/
?>