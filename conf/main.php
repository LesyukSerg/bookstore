<?php
    declare(strict_types=1);
    ini_set('display_errors', '0');
//    error_reporting(E_ALL);

    session_start();
    date_default_timezone_set('Europe/Kiev');

    define('ROOTDIR', $_SERVER['DOCUMENT_ROOT']);
    const view = ROOTDIR . '/View/';

    require_once ROOTDIR . '/autoload.php';
