<?php
require_once "common.php";

$name = $_REQUEST["name"];
$filename = SAVE_DIR."/$name";
echo file_exists($filename) ? "1" : "0";
?>
