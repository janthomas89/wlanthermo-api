<?php

use WlanThermo\API\Service\TemperatureService;
use WlanThermo\API\Service\LogfileService;
use WlanThermo\API\Service\ConfigService;
use WlanThermo\API\FrontController;

define('INDEX_FILE', true);
define('PATH_LIB', dirname(__FILE__));

/* Enable password protection */
FrontController::authenticate('wlanthermo', 'api');

/* Configure paths */
TemperatureService::$logfile = '/var/log/WLAN_Thermo/TEMPLOG.csv';
LogfileService::$pathThermolog = dirname(dirname(PATH_LIB)) . '/thermolog';
LogfileService::$pathThermoplot = dirname(dirname(PATH_LIB)) . '/thermoplot';
ConfigService::$pathConfiguration = dirname(dirname(PATH_LIB)) . '/conf';
