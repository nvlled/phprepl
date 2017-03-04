<?php
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function trimPHPTag($str) {
    $str = preg_replace("/^<\?php.*\n/m", "", $str);
    $str = preg_replace("/\?>$/m", "", $str);
    return $str;
}

function censor($str) {
    $censored = [
        "unlink",
        "file_put_contents",
        "fwrite",
        "rmdir",
        "delete",
        "ftruncate",
    ];
    $pat = implode("|", $censored);
    return preg_replace_callback("/\b($pat)\b/", function($match) {
        return $match[0]."_CENSORED";
    }, $str);
}

function _CENSORED_() { echo "function has been censored"; }

$script = @$_POST["script"] or die("*nothing to eval*");
$script = censor($script);

echo eval("?>".$script."<?php");

?>
