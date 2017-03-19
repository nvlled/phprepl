<?php
require_once "common.php";

$scriptName = @$_REQUEST["_"];
?>
<h2>Run script</h2>
[<a href='index.php?name=<?=$scriptName?>'>edit script</a>]
<hr>
<?php
@include SAVE_DIR."/$scriptName";
?>
