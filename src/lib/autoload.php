<?php

spl_autoload_register(function($class) {
    preg_match('/^(.+)?([^\\\\]+)$/U', ltrim($class, '\\'), $match);
    require str_replace('\\', '/', $match[1])
        . str_replace(array( '\\', '_' ), '/', $match[2])
        . '.php';
});
