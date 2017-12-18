<?php

/**
 * Class MergeSort
 */
class MergeSort
{
    /**
     * @param null $array_to_sort
     * @return array
     * @throws Exception
     */
    public static function Sort($array_to_sort = null)
    {
        if (!is_array($array_to_sort)) {
            throw new Exception('Argument passed must be an array!');
        }

        return self::_sort($array_to_sort);
    }

    /**
     * @param $array
     * @return bool
     */
    protected static function _is_associative_array($array)
    {
        if (array() === $array) return false;
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * @param $input
     * @param null $is_associative
     * @return array
     */
    protected static function _sort($input, $is_associative = null)
    {
        if (is_null($is_associative)) {
            $is_associative = self::_is_associative_array($input);
        }

        $size = count($input);

// base case
        if ($size < 2) {
            return $input;
        }

        $middle = floor($size / 2);
        $left = $input;
        $right = self::_array_pop_multi($left, $size - $middle);

        assert(count($left) + count($right) == $size);

        $left = self::_sort($left, $is_associative);
        assert(self::_is_sorted($left));

        $right = self::_sort($right, $is_associative);
        assert(self::_is_sorted($right));

        return self::_merge($left, $right, $is_associative);
    }

    /**
     * @param $from_array
     * @param $to_array
     * @param bool $is_associative
     */
    protected static function _shiftElement(&$from_array, &$to_array, $is_associative = false)
    {
        if ($is_associative) {
            $value = reset($from_array);
            $key = key($from_array);
            $to_array[$key] = $value;
            unset($from_array[$key]);
            return;
        }

        $to_array[] = array_shift($from_array);
        return;
    }

    /**
     * @param $array1
     * @param $array2
     * @param bool $is_associative
     * @return array
     */
    protected static function _merge($array1, $array2, $is_associative = false)
    {
        $result = [];

        while (count($array1) || count($array2)) {
            if (!count($array1)) {
                self::_shiftElement($array2, $result, $is_associative);
                continue;
            }

            if (!count($array2)) {
                self::_shiftElement($array1, $result, $is_associative);
                continue;
            }

            if (reset($array1) < reset($array2)) {
                self::_shiftElement($array1, $result, $is_associative);
                continue;
            }

            self::_shiftElement($array2, $result, $is_associative);
        }

        return $result;

    }

    /**
     * @param $array
     * @return bool
     */
    protected static function _is_sorted($array)
    {
        $previous_element = null;
        foreach ($array as $element) {
            if ($previous_element = null) {
                continue;
            }

            if ($previous_element > $element) {
                return false;
            }

            $previous_element = $element;
        }

        return true;

    }

    /**
     * @param $array
     * @param $n
     * @return array
     * @throws Exception
     */
    protected static function _array_pop_multi(&$array, $n)
    {
        if ($n > count($array)) {
            throw new Exception('MergeSort::array_pop_multi() - Cannot pop more elements than exist in array!');
        }

        $result = array();
        $is_associative = self::_is_associative_array($array);

        while ($n > 0) {
            $n--;

            if ($is_associative) {
                $value = end($array);
                $key = key($array);
                $result[$key] = $value;
                unset($array[$key]);
                continue;
            }

            $result[] = array_pop($array);
        }

        return $result;
    }
}