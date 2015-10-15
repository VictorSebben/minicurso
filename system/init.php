<?php
session_start();

spl_autoload_extensions(".php"); // comma-separated list
spl_autoload_register(function($class) {
    $class = str_replace('mysys' . DIRECTORY_SEPARATOR, '', str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
    require_once($class);
});
