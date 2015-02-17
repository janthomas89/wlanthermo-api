<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 16.02.15
 * Time: 19:44
 */

namespace WlanThermo\API\Service;


use WlanThermo\API\Exception\FileNotFoundException;

class TemperatureService
{
    /**
     * Path of the temperature logfile.
     *
     * @var sting
     */
    public static $logfile;


    /**
     * Returns the n latest values
     *
     * @param int $n
     * @return array
     * @throws FileNotFoundException
     */
    public function getLatest($n = 1)
    {
        $values = array();

        $file = $this->getFile();
        for ($i = count($file) - $n; $i < count($file); $i++) {
            if (!isset($file[$i])) {
                continue;
            }

            $row = str_getcsv($file[$i], ',');

            if (count($row) != 9 || $row[0] == 'Datum_Uhrzeit') {
                continue;
            }

            $date = $this->normalizeDate($row[0]);
            $values[$date] = array();

            for ($j = 0; $j < 8; $j++) {
                $values[$date][$j] = floatval($row[$j+1]);
            }
        }

        return $values;
    }

    /**
     * Creates a file handle, if the file exists.
     *
     * @return array
     * @throws FileNotFoundException
     */
    protected function getFile()
    {
        if (!is_readable(self::$logfile)) {
            throw new FileNotFoundException('Logfile ' . self::$logfile . ' ist not readable');
        }

        return file(self::$logfile);
    }

    /**
     * Normalizes the gives date.
     *
     * @param string $date
     * @return bool|string
     */
    protected function normalizeDate($date)
    {
        list($day, $time) = explode(' ', $date);
        list($d, $m, $y) = explode('.', $day);
        list($h, $i, $s) = explode(':', $time);

        $timestamp = mktime($h, $i, $s, $m, $d, $y);

        return date('c', $timestamp);
    }
} 