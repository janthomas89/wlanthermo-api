<?php

define('INDEX_FILE', true);
require_once dirname(__FILE__) . '/lib/config.php';

\WlanThermo\API\FrontController::dispatch($_GET, $_POST);
