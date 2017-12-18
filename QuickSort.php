<?php

/**
 * Class QuickSort
 */
class QuickSort
{
    /**
     * @param $input
     * @return mixed
     * @throws Exception
     */
    public static function Sort(&$input)
    {
        if (!is_array($input)) {
            throw new Exception('Argument passed must be an array!');
        }

        return self::_sort($input);
    }

    /**
     * @param $input
     * @param null $lo
     * @param null $hi
     * @return mixed
     */
    protected static function _sort(&$input, $lo = null, $hi = null)
    {
        if (is_null($lo)) {
            $lo = 0;
        }

        if (is_null($hi)) {
            $hi = count($input) - 1;
        }

        if ($lo < $hi) {
            $pi = self::_partition($input, $lo, $hi);

            self::_sort($input, $lo, $pi - 1);
            self::_sort($input, $pi + 1, $hi);
        }

        return $input;
    }

    /**
     * Partitions a subarray around a pivot and returns the pivot index
     *
     * @param array $input Input array
     * @param int $lo Starting index for subarray
     * @param int $hi Ending index for subarray
     *
     * @return int Position where the pivot ends up
     */
    protected static function _partition(&$input, $lo, $hi)
    {
        $pivot = self::_get_pivot_index($input, $lo, $hi);
        $pivot_value = $input[$pivot];

// place pivot at the end of the subarray
        self::_swap($input[$pivot], $input[$hi]);

        $i = $lo - 1;

// loop over all elements except pivot (hi)
        for ($j = $lo; $j < $hi; $j++) {
            if ($input[$j] <= $pivot_value) {
                $i++;
                self::_swap($input[$i], $input[$j]);
            }
        }

// place the pivot immediately after all lower elements
        self::_swap($input[$i + 1], $input[$hi]);

        return $i + 1;
    }

    /**
     * @param $input
     * @param $lo
     * @param $hi
     * @return mixed
     */
    protected static function _get_pivot_index(&$input, $lo, $hi)
    {
        return $hi;
    }

    /**
     * @param $a
     * @param $b
     */
    protected static function _swap(&$a, &$b)
    {
        $tmp = $a;
        $a = $b;
        $b = $tmp;
    }
}