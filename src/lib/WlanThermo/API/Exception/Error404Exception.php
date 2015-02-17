<?php

namespace WlanThermo\API\Exception;

require_once PATH_LIB . '/accessProtection.php';

/**
 * 404 Exception with extra payload.
 *
 * Class Error404Exception
 * @package WlanThermo\API\Exception
 */
class Error404Exception extends \Exception
{
    /**
     * @var array Extra Payload
     */
    protected $data;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
}
