<?php

namespace WlanThermo\API\Controller;

use WlanThermo\API\Exception\Error404Exception;

require_once PATH_LIB . '/access_protection.php';

abstract class AbstractController
{
    /**
     * @var array
     */
    protected $get;

    /**
     * @var array
     */
    protected $post;

    /**
     * Dispatches a request.
     *
     * @param array $get
     * @param array $post
     * @return array
     */
    public function dispatch(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;

        return $this->run();
    }

    /**
     * Runs the controller specific logic.
     *
     * @return array
     */
    public abstract function run();

    /**
     * Returns a GET parameter.
     *
     * @param string $index
     * @param mixed $default
     * @return string
     */
    protected function get($index, $default = '')
    {
         return isset($this->get[$index]) ? $this->get[$index] : $default;
    }

    /**
     * Determines wether the Request is POST or not.
     *
     * @return bool
     */
    protected function isPost()
    {
        return 'POST' == $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Returns a POST parameter.
     *
     * @param string $index
     * @param mixed $default
     * @return string
     */
    protected function post($index, $default = '')
    {
        return isset($this->post[$index]) ? $this->post[$index] : $default;
    }

    /**
     * Triggers a 404 error.
     *
     * @param $data
     * @throws Error404Exception
     */
    protected function trigger404(array $data)
    {
        $error = new Error404Exception();
        $error->setData($data);

        throw $error;
    }
}
