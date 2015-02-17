<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 16.02.15
 * Time: 20:49
 */

namespace WlanThermo\API\Controller;


use WlanThermo\API\Service\LogfileService;

class InfoController extends AbstractController
{
    /**
     * Runs the controller specific logic.
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