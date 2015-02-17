<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Service\ConfigService;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Controller for shutting down the device.
 *
 * Class ShutdownController
 * @package WlanThermo\API\Controller
 */
class ShutdownController extends AbstractController
{
    /**
     * Shuts down the device.
     *
     * @return array
     */
    public function run()
    {
        $service = new ConfigService();
        $service->queueShutdown();

        return array(
            'msg' => 'wlanthermo shutdown queued'
        );
    }

