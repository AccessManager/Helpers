<?php

namespace AccessManager\Helpers;

/**
 * Class Format
 * @package AccessManager\Helpers
 * This class handles formatting data to be displayed in a human readable format.
 */
class Format
{
    /**
     *  This method takes time duration in seconds and returns a string of human readable time duration.
     *
     * @param $seconds
     * @return null|string
     */
    public static function secondsToReadable( $seconds )
    {
        $mins = intval($seconds/60);
        $seconds = $seconds%60;
        $Hrs = intval($mins/60);
        $mins = $mins%60;
        $result = NULL;

        if( $Hrs != 0 ) {
            $result .= " $Hrs Hrs";
        }
        if( $mins != 0 ) {
            $result .= " $mins Mins";
        }
        if( $seconds != 0 ) {
            $result .= " $seconds Secs";
        }
        return $result;
    }

    /**
     * Following method takes number of bytes and converts that into higher (MB/GB) data units
     * and returns a string with the value and unit (MB/GB) suffix.
     *
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public static function bytesToReadable( $bytes, $precision = 2 )
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}