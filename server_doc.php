<?php
$file = $_FILES["file"]["name"];
$id = $_GET['id'];
$org = $_GET['org'];
$com = $_GET['com'];
if ($org > 0) {
    $dir = "doc/org_{$org}/";
} else {
    $dir = "doc/com_{$com}/";
}
$tipo = $_FILES['file']['type'];

$ext = explode("/", $tipo);

$extens = null;
if ($ext[1] == "msword") {
    $extens = "doc";
}

if ($ext[1] == "vnd.ms-excel") {
    $extens = "xls";
}

if ($ext[1] == "vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
    $extens = "xlsx";
}
if ($ext[1] == "vnd.openxmlformats-officedocument.wordprocessingml.document") {
    $extens = "docx";
}
if (strtoupper($ext[1]) == "JPG" || strtoupper($ext[1]) == "JPEG" || strtoupper($ext[1]) == "PNG" || strtoupper($ext[1]) == "PDF") {
    $extens = $ext[1];
}

if (!isset($extens)) {
    header('Location: doc_error.php');
    die();
}
try {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
} catch (Exception $e) {
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://greencloud.xyz/public/api/duplicardoc?id={$id}&tipo={$extens}");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$a = json_decode($output);
$id = $a->data;
curl_close();
if ($org > 0) {
    move_uploaded_file($_FILES["file"]["tmp_name"], "doc/org_{$org}/" . $id . '.' . $extens);
} else {
    move_uploaded_file($_FILES["file"]["tmp_name"], "doc/com_{$com}/" . $id . '.' . $extens);
}
header('Location: doc_ok.php');
die();
