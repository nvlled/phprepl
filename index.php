<?php include "header.inc.php" ?>
<link rel="stylesheet" href="resources/editor.css" />
<?php
require_once "common.php";

$name = @$_REQUEST["name"];
$script = "";
if ($name) {
    $script = @file_get_contents(SAVE_DIR."/$name");
}
$isExisting = $name && strlen($script) > 0;

?>

<form name="save" method="post">
    script name: 
    <input type="text" name="name" value="<?=$name?>"/>
    <input type="hidden" name="original-name" value="<?=$name?>"/>
    <input class="" type="submit" name="action" value="save script" />
    <input type="hidden" name="existing" value="<?=$isExisting?1:0?>" />
    <img class="spinner" src="resources/spinner.gif" />
    <span class="msg"></span>
</form>

<em>Note: Wrap the php code in php tags</em>
<form name="eval" method="post">
  <br>
  <textarea rows="0" name="cmd"><?=$script?></textarea>
  <br><input type="submit" name="action" value="execute"/> 
  <?php if ($isExisting) { ?>
  [<a href='run.php?_=<?=$name?>'>run script in a separate page</a> (Do this when the script uses forms)]
  <?php } ?>
  <img class="spinner" src="resources/spinner.gif" />
</form>
<h3>output</h3>
<hr>
<div id="output">
</div>

<script src="resources/cm/codemirror.js"></script>
<script src="resources/cm/codemirror.js"></script>
<script src="resources/cm/matchbrackets.js"></script>
<script src="resources/cm/htmlmixed.js"></script>
<script src="resources/cm/xml.js"></script>
<script src="resources/cm/javascript.js"></script>
<script src="resources/cm/clike.js"></script>

<script src="resources/cm/php.js"></script>
<link rel="stylesheet" href="resources/cm/codemirror.css" />
<link rel="stylesheet" href="resources/cm/zenburn.css" />

<script src="resources/repl.js"></script>

<?php include "footer.inc.php" ?>

