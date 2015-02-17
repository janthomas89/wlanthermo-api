<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 16.02.15
 * Time: 20:54
 */

namespace WlanThermo\API\Service;


class LogfileService
{
    /**
     * @var string Path of the log files
     */
    public static $pathThermolog;

    /**
     * @var string Path of the plot files
     */
    public static $pathThermoplot;

    /**
     * Clears the log files.
     *
     * @return array
     */
    public function clearLogs()
    {
        return $this->clear(self::$pathThermolog);
    }

    /**
     * Returns the stats of the log files.
     *
     * @return array
     */
    public function statsLogfiles()
    {
        return $this->stats(self::$pathThermolog);
    }

    /**
     * Clears the plot files.
     *
     * @return array
     */
    public function clearPlots()
    {
        return $this->clear(self::$pathThermoplot);
    }

    /**
     * Returns the stats of the plot files.
     *
     * @return array
     */
    public function statsPlots()
    {
        return $this->stats(self::$pathThermoplot);
    }

    /**
     * Clears the given path.
     *
     * @param string $path
     * @return array
     */
    protected function clear($path)
    {
        $cleared = array();

        $iterator = new \DirectoryIterator($path);
        foreach ($iterator as $file) {
            if($file->isDot()) {
                continue;
            }

            if (unlink($file->getPathname())) {
                $cleared[] = $file->getFilename();
            }
        }

        return $cleared;
    }

    /**
     * Returns the stats of a given path.
     *
     * @param string $path
     * @return array
     */
    protected function stats($path)
    {
        $stats = array();

        $iterator = new \DirectoryIterator($path);
        foreach ($iterator as $file) {
            if($file->isDot()) {
                continue;
            }

            $stats[$file->getFilename()] = $this->filesizeReadable($file->getSize());
        }

        return $stats;
    }

    /**
     * Returns a human readable version of the given filesize.
     *
     * @param int $bytes
     * @param int $decimals
     * @return string
     */
    protected function filesizeReadable($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}
