<?php 

namespace config;

    define('ROOT', str_replace('\\','/',dirname(__DIR__) . "/"));

    $base = explode($_SERVER['DOCUMENT_ROOT'], ROOT);

    define("BASE", $base[1]);
    define('HOST', "localhost");
    define('USER', "root");
    define('PASS', "");
    define('DB', "gotoevent");

?>

