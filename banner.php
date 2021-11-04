<?php
require_once 'vendor/autoload.php';
$config = require 'config.php';

use testApplication\View as View;
use testApplication\Image as Image;

try {
    $db = new PDO('mysql:host='.$config['dbHost'].';dbname='.$config['dbName'], $config['dbUser'], $config['dbPass']);
} catch (PDOException $e) {
    print "DB Error!: " . $e->getMessage();
    die();
}

/*  Get user ip */
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
}

/*  Convert ip to number */
$ipAddress = ip2long($ipAddress);

$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$viewDate = date('Y-m-d H:i:s', time());
$pageUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

/*  Record user data    */
$view = new View($ipAddress , $userAgent ,$viewDate, $pageUrl, $db);
$view->hit();

/*  Paint image */
header('Content-Type: image/jpeg');
$image = new Image ( $viewDate );
$image->generateImage(250, 50);
