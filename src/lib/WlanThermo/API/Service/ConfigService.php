<?php

namespace WlanThermo\API\Service;

use WlanThermo\API\Exception\FileNotFoundException;
use WlanThermo\API\Exception\InvalidConfigException;

/**
 * Service class for managing the configuration of wlanthermo.
 *
 * Class ConfigService
 * @package WlanThermo\API\Service
 */
class ConfigService
{
    /**
     * @var string Path of the configuration files.
     */
    public static $pathConfiguration;

    /**
     * @var array Main configuration.
     */
    protected $config;

    /**
     * @var array Probe configuration.
     */
    protected $probeConfig;

    /**
     * Reads and returns the configuration.
     *
     * @return array
     * @throws FileNotFoundException
     * @throws InvalidConfigException
     */
    public function getConfig()
    {
        $this->readConfig();
        return $this->config;
    }

    /**
     * Reads and returns the probe configuration.
     *
     * @return array
     * @throws FileNotFoundException
     * @throws InvalidConfigException
     */
    public function getProbeConfig()
    {
        $this->readProbeConfig();
        return $this->probeConfig;
    }

    /**
     * Updates the settings of the given probe
     *
     * @param int $index
     * @param boolean $enabled
     * @param string $probeType
     */
    public function updateProbe($index, $enabled, $probeType)
    {
        if ($index < 0 || $index > 7) {
            throw new \InvalidArgumentException('Invalid probe index given. Valid values are 0 to 7.');
        }

        if (!$this->isValidProbeType($probeType)) {
            throw new \InvalidArgumentException('Probe type ' . $probeType . ' not found.');
        }

        $this->readConfig();
        $this->config['Sensoren']['ch' . (int)$index] = (int)$probeType;
        $this->config['Logging']['ch' . (int)$index] = $enabled ? 'True' : 'False';
        $this->saveConfig();
    }

    /**
     * Queues a shutdown of the system.
     */
    public function queueShutdown()
    {
        $this->readConfig();
        $index = $this->config['Hardware']['version'] == 'v3'
            ? 'raspi_v3_shutdown' : 'raspi_shutdown';
        $this->config['ToDo'][$index] = 'True';
        $this->saveConfig();
    }

    /**
     * Queues a restart of the system.
     */
    public function queueRestart()
    {
        $this->readConfig();
        $this->config['ToDo']['raspi_reboot'] = 'True';
        $this->saveConfig();
    }

    /**
     * Checks if the given probe type is valid.
     *
     * @param $probeType
     * @return bool
     */
    protected function isValidProbeType($probeType)
    {
        $probes = $this->getProbeConfig();
        foreach ($probes as $probe) {
            if ($probe['number'] == (int)$probeType) {
                return true;
            }
        }

        return false;
    }

    /**
     * Reads in the config file.
     *
     * @throws FileNotFoundException
     */
    protected function readConfig()
    {
        $file = self::$pathConfiguration . '/WLANThermo.conf';

        if (!is_readable($file)) {
            throw new FileNotFoundException('Config file ' . $file . ' not readable');
        }

        $res = parse_ini_file ($file, true, INI_SCANNER_RAW);
        if (!is_array($res)) {
            throw new InvalidConfigException('Invalid configuration file ' . $file);
        }

        $this->config = $res;
    }

    /**
     * Reads in the probe config file.
     *
     * @throws FileNotFoundException
     */
    protected function readProbeConfig()
    {
        $file = self::$pathConfiguration . '/sensor.conf';

        if (!is_readable($file)) {
            throw new FileNotFoundException('Config file ' . $file . ' not readable');
        }

        $res = parse_ini_file ($file, true, INI_SCANNER_RAW);
        if (!is_array($res)) {
            throw new InvalidConfigException('Invalid configuration file ' . $file);
        }

        $this->probeConfig = $res;
    }

    /**
     * Saves the current configuration back to file.
     */
    protected function saveConfig()
    {
        $res = array();
        foreach($this->config as $category => $settings) {
            $res[] = '[' . $category . ']';

            foreach ($settings as $key => $value) {
                $res[] = $key . ' = ' . $value;
            }

            $res[] = '';
        }

        $fileContent = implode("\n", $res);
        file_put_contents(self::$pathConfiguration . '/WLANThermo.conf', $fileContent);
    }
} 