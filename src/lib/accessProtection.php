<?php

if (!defined('INDEX_FILE')) {
    \WlanThermo\API\FrontController::trigger404(array(
        'msg' => 'Not found'
    ));
}