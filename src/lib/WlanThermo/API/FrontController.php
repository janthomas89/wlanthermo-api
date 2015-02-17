<?php

namespace WlanThermo\API;

use WlanThermo\API\Exception\Error404Exception;

require_once PATH_LIB . '/accessProtection.php';

/**
 * Simple FrontController class for dispatching incoming
 * requests.
 *
 * Class FrontController
 * @package WlanThermo\API
 */
class FrontController
{
    /**
     * Dispatches the given request,
     *
     * @param array $get
     * @param array $post
     */
    public static function dispatch(array $get, array $post)
    {
        $action = isset($get['action']) ? $get['action'] : '';
        $controller = array(
            'clear'     => 'ClearLogfilesController',
            'config'    => 'ConfigController',
            'info'      => 'InfoController',
            'latest'    => 'LatestTemperatureController',
            'restart'   => 'RestartController',
            'shutdown'  => 'ShutdownController',
        );

        if (isset($controller[$action])) {
            try {
                $class = '\\WlanThermo\\API\\Controller\\' . $controller[$action];
                $controller = new $class;
                $result = $controller->dispatch($get, $post);
                self::jsonResponse($result);
            } catch (Error404Exception $e) {
                self::trigger404($e->getData());
            }
        } else {
            self::trigger404(array(
                'msg' => 'Not found, try ?action=latest'
            ));
        }
    }

    /**
     * Triggers a 404 error and terminates the request.
     *
     * @param array $data
     */
    public static function trigger404(array $data)
    {
        $data['status'] = 404;

        header('HTTP/1.0 404 Not Found');
        self::jsonResponse($data);
    }

    /**
     * Authenticates the given user.
     *
     * @param string $user
     * @param string $password
     */
    public static function authenticate($user, $password)
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])
            || !isset($_SERVER['PHP_AUTH_PW'])
            || $_SERVER['PHP_AUTH_USER'] != $user
            || $_SERVER['PHP_AUTH_PW'] != $password
        ) {
            header('WWW-Authenticate: Basic realm="Wlanthermo API"');
            header('HTTP/1.0 401 Unauthorized');
            self::jsonResponse(array(
                'status' => 401,
                'msg' => 'unauthorized',
            ));
            exit;
        }
    }

    /**
     * Terminates the request by sending a JSON response.
     *
     * @param array $data
     */
    protected static function jsonResponse(array $data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 200;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}
