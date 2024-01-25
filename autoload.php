<?php
    spl_autoload_register(function ($className) {
        $not = ['Classes\mysqli'];
        $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

        if (!in_array($className, $not)) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '\\' . $classFile)) {
                require_once $classFile;
            } else {
                die("Class file not found: $classFile");
            }
        }
    });
