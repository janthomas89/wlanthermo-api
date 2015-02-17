<?php

if (!defined('INDEX_FILE')) {
    \WlanThermo\API\FrontController::dispatch404(array(
        'msg' => 'Not found'
    ));
}