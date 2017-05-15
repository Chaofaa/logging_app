<?php

function url(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        str_replace(basename(__FILE__), '', $_SERVER['SCRIPT_NAME'])
    );
}

define('base_path', __DIR__);
define('base_url', url());

require __DIR__.'/vendor/autoload.php';

require __DIR__.'/app/router.php';