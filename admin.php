<?php
require_once "common.php";

$adminSha = "a712f86e86a2dab900642eae5938ef5c548443ed";

$pass = @$_REQUEST["pass"];
$out = @$_REQUEST["out"];

if ($out) {
    $_SESSION["admin"] = false;
    header("location: index.php?msg=admin nope");
} else if (sha1($pass) == $adminSha) {
    $_SESSION["admin"] = true;
    header("location: index.php?msg=admin okay");
} else {
    echo "access denied, only a demo";
}

?>
