<?php

/**
 * Class SortUtility
 */
class SortUtility {
    /**
     * @param $n
     * @param int $lo
     * @param int $hi
     * @return array
     */
    public static function populateArray($n, $lo = 0, $hi = 1000) {
        $result = [];

        while ($n > 0) {
            $result[] = mt_rand($lo, $hi);
            $n--;
        }

        return $result;
    }
}