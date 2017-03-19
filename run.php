<?php include "header.inc.php" ?>
<?php
require_once "common.php";

$scriptName = @$_REQUEST["_"];
?>
<p>Script: <b><?=htmlspecialchars($scriptName)?></b> 
[<a href='index.php?name=<?=$scriptName?>'>edit script</a>]
</p>

<h3>output</h3>
<hr>
<?php
@include SAVE_DIR."/$scriptName";
?>
<?php include "footer.inc.php" ?>
