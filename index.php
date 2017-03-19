<?php include "header.inc.php" ?>
<link rel="stylesheet" href="editor.css" />
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
    <input type="text" name="name" 
        <?=$isExisting?"readonly":""?>
        value="<?=$name?>"/>
    <input class="" type="submit" name="action" value="save script" />
    <input type="hidden" name="existing" value="<?=$isExisting?1:0?>" />
    <img class="spinner" src="spinner.gif" />
    <span class="msg"></span>
</form>

<em>Note: Wrap the php code in php tags</em>
<form name="eval" method="post">
  <br>
  <textarea rows="0" name="cmd"><?=$script?></textarea>
  <div id="editor" style=""></div>
  <span class="drag"></span>
  <br><input type="submit" name="action" value="execute"/> 
  [<a href='run.php?_=<?=$name?>'>run script in a separate page</a> (Do this when the script uses forms)]
  <img class="spinner" src="spinner.gif" />
</form>
<h3>output</h3>
<hr>
<div id="output">
</div>
<?php

?>

<script src="monaco-editor/min/vs/loader.js"></script>
<script src="resizer.js"></script>
<script src="repl.js"></script>

<?php include "footer.inc.php" ?>
