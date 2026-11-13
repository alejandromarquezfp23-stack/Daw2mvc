<?php
$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
$applicationPath = rtrim(str_replace('\\', '/', dirname($scriptPath)), '/');
define("url", ($applicationPath === '' ? '' : $applicationPath) . '/');
define("default_controller", "home");
define("default_action", "index");
