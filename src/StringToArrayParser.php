<?php

namespace AccessManager\Helpers;

/**
 * Class StringToArrayParser
 * @package AccessManager\Helpers
 */
class StringToArrayParser
{
    /**
     * holds string to work on.
     *
     * @var
     */
    private $str;

    /**
     * Parse the string to array.
     *
     * @return array
     */
    public function parseToArray()
    {
        $explodedArray = explode(',', $this->getTrimmedStr());
        $filteredArray = array_filter($explodedArray);
        return $filteredArray == null ? [] : $filteredArray;
    }

    /**
     * Trims to array from non required characters.
     *
     * @return string
     */
    private function getTrimmedStr()
    {
        return trim($this->str, "\,\`\[\].\;");
    }

    /**
     * StringToArrayParser constructor.
     * @param $str String
     */
    public function __construct( $str )
    {
        $this->str = $str;
    }
}