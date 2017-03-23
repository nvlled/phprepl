<?php
session_start();
define("SAVE_DIR", "scripts");

function getSessionScripts() {
    $scripts = @$_SESSION["scripts"];
    if ($scripts)
        return $scripts;
    return array();
}

function ownsScript($name) {
    if (@$_SESSION["admin"])
        return true;
    $scripts = getSessionScripts();
    return !!@$scripts[$name];
}

function saveSessionScript($name) {
    $scripts = getSessionScripts();
    $scripts[$name] = 1;  
    $_SESSION["scripts"] = $scripts;
}

?>
