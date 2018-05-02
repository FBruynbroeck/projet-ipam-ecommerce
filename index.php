<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = array_filter(explode('/', $uri));

if (count($segments) === 0 or $segments[1] === 'index')
{
    $segments[1] = 'welcome';
}
$controller = 'controllers/'.implode('/', $segments).'.php';
if (file_exists($controller)) {
    include $controller;
}
else {
    include 'controllers/404.php';
}

?>
