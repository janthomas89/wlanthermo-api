<?php

namespace WlanThermo\API\Controller;


use WlanThermo\API\Service\ConfigService;

class ShutdownController extends AbstractController
{
    /**
     * Runs the controller specific logic.
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
}