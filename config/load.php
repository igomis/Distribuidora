<?php
use Jenssegers\Blade\Blade;
require dirname(__FILE__) . "/../vendor/autoload.php";
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
$blade = new Blade('../views','../cache');
if ($_SERVER['PHP_SELF']!='/login.php' && strpos($_SERVER['PHP_SELF'],'/api') === false) {
    checkSession();
}
