<?php
/*
 * CKFinder
 * ========
 * https://ckeditor.com/ckeditor-4/ckfinder/
 * Copyright (c) 2007-2018, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */

require_once __DIR__ . '/vendor/autoload.php';
session_start();
use CKSource\CKFinder\CKFinder;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Session {
    public static function unserialize($session_data) {
        $method = ini_get("session.serialize_handler");
        switch ($method) {
            case "php":
                return self::unserialize_php($session_data);
                break;
            case "php_binary":
                return self::unserialize_phpbinary($session_data);
                break;
            default:
                throw new Exception("Unsupported session.serialize_handler: " . $method . ". Supported: php, php_binary");
        }
    }

    private static function unserialize_php($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            if (!strstr(substr($session_data, $offset), "|")) {
                throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
            }
            $pos = strpos($session_data, "|", $offset);
            $num = $pos - $offset;
            $varname = substr($session_data, $offset, $num);
            $offset += $num + 1;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }

    private static function unserialize_phpbinary($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            $num = ord($session_data[$offset]);
            $offset += 1;
            $varname = substr($session_data, $offset, $num);
            $offset += $num;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }
}
$session_id = $_COOKIE['ci_session'];
// get the session data by session_id,replace to your session save path

$content = file_get_contents('../../../../../../application/common/session/ci_session' . $session_id);
session_start();
$session = Session::unserialize($content);

if (isset($session['login']) && $session['login']['check'] === true ) {
    $_SESSION['check'] = true;
} else {
    session_destroy();
}

// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/debug.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());
//$logger->info(json_encode($_SESSION));


$ckfinder = new CKFinder(__DIR__ . '/../../../config.php');

$ckfinder->run();
