<?php
$file = $_FILES["file"]["name"];
$id = $_GET['id'];
move_uploaded_file($_FILES["file"]["tmp_name"], "img/reduccion/" . $id . '.jpg');
header('Location: doc_ok.php');
