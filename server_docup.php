<?php
$file = $_FILES["file"]["name"];
$id = $_GET['id'];
$org = $_GET['org'];
$mes = $_GET['mes'];
$tipo = $_FILES['file']['type'];
$name = $id . '_' . $org . '_' . $mes;
$dir = "img/up/";
try {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
} catch (Exception $e) {
}

try {
    unlink("img/up/" . $name . '.pdf');
} catch (Exception $e) {
}
try {
    unlink("img/up/" . $name . '.jpg');
} catch (Exception $e) {
}
try {
    unlink("img/up/" . $name . '.xlsx');
} catch (Exception $e) {
}
if ($_FILES["file"]['type'] == 'application/pdf') {
    move_uploaded_file($_FILES["file"]["tmp_name"], "img/up/" . $name . '.pdf');
} else if ($_FILES["file"]['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
    move_uploaded_file($_FILES["file"]["tmp_name"], "img/up/" . $name . '.xlsx');
} else {
    move_uploaded_file($_FILES["file"]["tmp_name"], "img/up/" . $name . '.jpg');
}
header('Location: doc_ok.php');
die();

