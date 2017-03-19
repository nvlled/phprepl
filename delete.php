<?php include "header.inc.php" ?>
<?php
require_once "common.php";
$scriptName = @$_REQUEST["name"];
if (!$scriptName) {
    header("location: index.php");
}
$filename = SAVE_DIR."/$scriptName";
if (! file_exists($filename)) {
    die("script does not exist: $scriptName");
} 

if (! ownsScript($scriptName)) {
    die("access denied");
}

$action = @$_REQUEST["action"];
if ($action == "yes") {
    unlink($filename);
    echo  $filename;
    header("location: index.php?msg=Script has been deleted");
} else if ($action == "no") {
    header("location: index.php?name=".$scriptName);
}
?>

<h2>Delete script <?=$scriptName?>?</h2>
<form>
    <input type="hidden" name="name" value="<?=$scriptName?>"/>
    <input type="submit" name="action" value="yes" />
    <input type="submit" name="action" value="no" />
</form>
