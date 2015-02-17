<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Exception\Error404Exception;
use WlanThermo\API\Service\TemperatureService;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Controller for requesting the n latest temperature values.
 *
 * Class CurrentTemperature
 * @package WlanThermo\API\Controller
 */
class LatestTemperatureController extends AbstractController
{
    /**
     * Runs the controller specific logic.
     *
     * @return array
     */
    public function run()
    {
        $service = new TemperatureService();

        $n = $this->getLimit();
        $values = $service->getLatest($n);

        return array(
            'values' => $values
        );
    }

    /**
     * Retrieves an validates the limit Parameter.
     *
     * @return int
     * @throws Error404Exception
     */
    protected function getLimit()
    {
        $n = (int)$this->get('limit', 1);

        if ($n < 1 || $n > 1000) {
            $this->trigger404(array(
                'msg' => 'Parameter n has to be between 1 and 1000'
            ));
        }

        return $n;
    }
}
