<?php
require_once "common.php";

$name = $_POST["name"];
$script = $_POST["script"];
$filename = SAVE_DIR."/$name";

if ( ! file_exists($filename)) {
    saveSessionScript($name);
} else if ( ! ownsScript($name)) {
    echo "*you do not own the script, use a different script name to save";
    exit;
}


@mkdir(dirname($filename), 0777, true);

$return = @file_put_contents($filename, $script);
if ($return === false) {
    echo "*saving $name failed, probably an invalid filename";
}

?>
