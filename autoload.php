<?php

//set_include_path(realpath('/path/to/lib') . PATH_SEPARATOR . get_include_path());


spl_autoload_register(function ($class) {
    include  $class . '.php';
});

ini_set('display_errors',1); 
error_reporting(E_ALL)
?>

