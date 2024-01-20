<?php
$file = $_FILES["file"]["name"];
$id = $_GET['id'];
$org = $_GET['org'];
$dir = "img/verificable/";
try {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
} catch (Exception $e) {
}
try {
    unlink("img/verificable/" . $id . '.pdf');
} catch (Exception $e) {
}
try {
    unlink("img/verificable/" . $id . '.jpg');
} catch (Exception $e) {
}
try {
    unlink("img/verificable/" . $id . '.xlsx');
} catch (Exception $e) {
}
if ($_FILES["file"]['type'] == 'application/pdf') {
    move_uploaded_file($_FILES["file"]["tmp_name"], "img/verificable/" . $id . '.pdf');
} else if ($_FILES["file"]['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
    move_uploaded_file($_FILES["file"]["tmp_name"], "img/verificable/" . $id . '.xlsx');
} else {
    move_uploaded_file($_FILES["file"]["tmp_name"], "img/verificable/" . $id . '.jpg');
}