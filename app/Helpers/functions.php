<?php

/**
 * Debugging function that prints an array inside a <pre> tag.
 *
 * @param {Array} Array data to print.
 * @param {Boolean} Controls whether the script should exit
 */
function print_pre($array, $die = false)
{
    print('<pre>'.print_r($array, true).'</pre>');
    if ($die === true) {
        die();
    }
}

/**
 * Function that groups an array of associative arrays by a key.
 *
 * @param {String} $key Property to sort by.
 * @param {Array} $data Array that stores multiple associative arrays.
 */
function group_by($key, $data)
{
    $result = array();

    foreach ($data as $val) {
        if (array_key_exists($key, $val)) {
            $result[$val[$key]][] = $val;
        } else {
            $result[''][] = $val;
        }
    }

    return $result;
}
