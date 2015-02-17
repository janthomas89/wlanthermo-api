<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Service\ConfigService;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Controller for getting and setting the configuration.
 *
 * Class ConfigController
 * @package WlanThermo\API\Controller
 */
class ConfigController extends AbstractController
{
    /**
     * Gets or sets the configuration.
     *
     * @return array
     */
    public function run()
    {
        $response = array();
        if ($this->isPost()) {
            $response = $this->handlePost();
        }

        $service = new ConfigService();

        return array_merge($response, array(
            'config' => $service->getConfig(),
            'probeConfig' => $service->getProbeConfig(),
        ));
    }

    /**
     * Handles updates of the configuration.
     *
     * @return array
     */
    protected function handlePost()
    {
        $service = new ConfigService();
        $service->updateProbe(
            (int)$this->post('index'),
            (int)$this->post('enabled') == 1,
            (int)$this->post('probeType')
        );

        return array(
            'msg' => 'probe ' . (int)$this->post('index') . ' updated'
        );
    }
}
