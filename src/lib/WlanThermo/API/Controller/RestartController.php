<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Service\ConfigService;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Controller for restarting the device.
 *
 * Class RestartController
 * @package WlanThermo\API\Controller
 */
class RestartController extends AbstractController
{
    /**
     * Restarts the device.
     *
     * @return array
     */
    public function run()
    {
        $service = new ConfigService();
        $service->queueRestart();

        return array(
            'msg' => 'wlanthermo restart queued'
        );
    }
}
