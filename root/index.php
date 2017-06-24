<?php
define("APP_PATH",  realpath(dirname(__FILE__) . '/../'));
try {
    $app = new Yaf_Application(APP_PATH . "/conf/application.ini");
    $app->bootstrap()->run();
} catch (Exception $e) {
    var_dump($e);
    header("Location: /404.html");
    exit;
}
