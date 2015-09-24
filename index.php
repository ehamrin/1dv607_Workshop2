<?php

    spl_autoload_register(function ($class) {
        $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
        $filename = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class . '.php';
        if(file_exists($filename)){
            require_once $filename;
        }
    });

    $c = new \controller\Program();
    $c->Main();