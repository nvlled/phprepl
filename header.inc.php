<html>
<head>
    <link rel="stylesheet" href="site.css" />
</head>
<body>
<h1 class="site"><a href="index.php">PHP REPL</a></h1>
<?php
$links = [
    "browse" => "browse.php",
    "about" => "about.php",
    "new" => "index.php",
];
?>
<nav class="site">
    <ul>
    <?php foreach ($links as $text => $href) { ?>
        <li>[<a href="<?=$href?>"><?=$text?>]</a>
    <?php } ?>
    </ul>
</nav>

<p>Quickly try and test PHP code
    <span style="color: green">
    <?php
        $msg = @$_REQUEST["msg"];
        if ($msg) {
            echo " |$msg|";
        }
    ?>
    </span>
</p>
