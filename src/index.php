<?php

require_once dirname(__FILE__) . '/lib/autoload.php';
require_once  dirname(__FILE__) . '/lib/config.php';

\WlanThermo\API\FrontController::dispatch($_GET, $_POST);
