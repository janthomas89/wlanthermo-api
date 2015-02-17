<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Service\LogfileService;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Controller for clearing the log- and plotfiles.
 *
 * Class ClearLogfilesController
 * @package WlanThermo\API\Controller
 */
class ClearLogfilesController extends AbstractController
{
    /**
     * Clears the log- and plotfiles.
     *
     * @return array
     */
    public function run()
    {
        $service = new LogfileService();

        return array(
            'logs' => $service->clearLogs(),
            'plots' => $service->clearPlots(),
        );
    }
}
