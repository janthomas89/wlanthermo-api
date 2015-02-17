<?php

namespace WlanThermo\API\Controller;


use WlanThermo\API\Service\ConfigService;

class RestartController extends AbstractController
{
    /**
     * Runs the controller specific logic.
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