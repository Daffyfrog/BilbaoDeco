<?php
$name = $_POST['name'];
$id = $_POST['id'];
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/img/articles/" .  $id . "/";
print_r($_FILES);
$target_file = $target_dir . basename($_FILES["file"]["name"]);
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
print_r($target_dir);
print_r($target_file);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
