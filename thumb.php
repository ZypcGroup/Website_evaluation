<?php
include_once('config.inc.php');

if(!(isset($_GET['itemno']) && isset($_GET['group']))) {
    header('Location: /style/img/404.png');
    exit();
}

$item = loadParticipatantDetail($_GET['group'], intval($_GET['itemno']));
if(!isset($item)) {
    header('Location: /style/img/404.png');
    exit();
}
$addr = $item['img_addr'];
$localAddr = itemImageAddr($item);
if(substr($addr, 0, 1) == '/') {
    $addr = substr($addr, 1);
}
if(PHP_OS == 'WINNT') {
    $addr = iconv("UTF-8", "GB2312", $addr);
}
if(!file_exists($localAddr)) {
    if(substr($addr, strlen($addr) - 4, 4) == '.png') {
        $image = imagecreatefrompng($addr);
    } else {
        $image = imagecreatefromjpeg($addr);
    }
    if(!isset($image)) {
        header('Location: /style/img/404.png');
        exit();
    }
    $a=getimagesize($addr);
    if($a[0] > 360) {
        $width = 360;
        $height = $width / $a[0] * $a[1];
    } else {
        $width = $a[0];
        $height = $a[1];
    }
    $newimage = imagecreatetruecolor($width, $height);
    imagecopyresampled($newimage, $image, 0, 0, 0, 0, $width, $height, $a[0], $a[1]);
    imagejpeg($newimage, $localAddr, 90);
}
header("Location: $localAddr");
