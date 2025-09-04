<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($uri, '/'));
$rootDir = dirname(__DIR__);
$folder = $parts[0] ?? '';

$apiPath = "$rootDir/api/$folder/index.php";

if ($folder && is_file($apiPath)) {
    if (isset($parts[1]) && str_ends_with($parts[1], '.php')) {
        header("Location: /$folder/");
        exit;
    }

    require $apiPath;
    exit;
}

require __DIR__ . '/index.php';
?>