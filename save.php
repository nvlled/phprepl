<?php
require_once "common.php";

$name = $_POST["name"];
$script = $_POST["script"];

$filename = SAVE_DIR."/$name";

echo "<p>[$name] [$filename]</p>";
echo "<p>".dirname($filename)."</p>";
@mkdir(dirname($filename), 0777, true);

$return = file_put_contents($filename, $script);
if ($return === false) {
    echo "saving $name failed";
}

?>
