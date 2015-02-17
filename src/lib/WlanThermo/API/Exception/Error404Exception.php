<?php

namespace WlanThermo\API\Exception;

require_once PATH_LIB . '/access_protection.php';

class Error404Exception extends \Exception
{
    /**
     * @var array
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