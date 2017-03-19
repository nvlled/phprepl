<?php include "header.inc.php" ?>

<h2>Saved scripts</h2>
<?php
require_once "common.php";

$dir_iterator = new RecursiveDirectoryIterator(SAVE_DIR);
$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
// could use CHILD_FIRST if you so wish
//

$ownedScripts = getSessionScripts();

$count = 0;
echo "<table>";
foreach ($iterator as $file) {
    $basename = $file->getBaseName();
    if ($basename == "." || $basename == ".." || $file->isDir())
        continue;
    $count++;

    $name = $file->getPath()."/".$file->getFilename();
    $name = preg_replace("/^".SAVE_DIR."\//", "", $name);
    echo "<tr></td>";
    echo "<td class='script'><a class='xlscript' href='index.php?name=$name'>";
    echo htmlspecialchars($name);
    echo "</a></td>";
    if (@$ownedScripts[$name])
        echo "<td>[<a class='del' href='delete.php?name=$name'>delete</a>]</td>";
    echo "</tr>";
}
echo "</table>";

if ($count == 0) {
    echo "(no saved scripts found)";
}

?>
<style>
.script {
    text-align: right;
    min-width: 150px;
}
a.del {
    color: gray;
    text-decoration: none;
    font-size: 12px;
}
</style>

<?php include "footer.inc.php" ?>
