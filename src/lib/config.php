<?php

use WlanThermo\API\Service\TemperatureService;
use WlanThermo\API\Service\LogfileService;
use WlanThermo\API\Service\ConfigService;
use WlanThermo\API\FrontController;

/* Paths */
define('PATH_LIB', dirname(__FILE__));

/* Autoloading */
spl_autoload_register(function($class) {
    preg_match('/^(.+)?([^\\\\]+)$/U', ltrim($class, '\\'), $match);
    require str_replace('\\', '/', $match[1])
        . str_replace(array( '\\', '_' ), '/', $match[2])
        . '.php';
});

/* Enable password protection */
FrontController::authenticate('wlanthermo', 'api');

/* Configure paths */
TemperatureService::$logfile = '/var/log/WLAN_Thermo/TEMPLOG.csv';
LogfileService::$pathThermolog = dirname(dirname(PATH_LIB)) . '/thermolog';
LogfileService::$pathThermoplot = dirname(dirname(PATH_LIB)) . '/thermoplot';
ConfigService::$pathConfiguration = dirname(dirname(PATH_LIB)) . '/conf';

require_once 'accessProtection.php';
