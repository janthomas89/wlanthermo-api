<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Service\LogfileService;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Controller for getting some device info such as
 * number and size of logfiles.
 *
 * Class InfoController
 * @package WlanThermo\API\Controller
 */
class InfoController extends AbstractController
{
    /**
     * Retrieves the info.
     *
     * @return array
     */
    public function run()
    {
        $logfileService = new LogfileService();

        return array(
            'logs' => $logfileService->statsLogfiles(),
            'plots' => $logfileService->statsPlots(),
        );
    }
}
