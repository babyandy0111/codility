<?php

/**
 * Flags
 *
 *  Find the maximum number of flags that can be set on mountain peaks.
 */


include '../../Tests.class.php';

function solution($A)
{
    $sizeOfA = sizeof($A);
    $next = next_peaks($A);
    $i = 1;
    $result = 0;
    while ($i * ($i - 1) <= $sizeOfA) {
        $pos = 0;
        $num = 0;
        while ($pos < $sizeOfA && $num < $i) {
            $pos = $next[$pos];
            if ($pos == -1) {
                break;
            }
            $num += 1;
            $pos += $i;
        }
        $i++;
        $result = max($result, $num);
    }

    return $result;
}

function peaks($A)
{
    $sizeOfA = sizeof($A);
    $peaks = array();
    $peaks[0] = false;
    for ($i = 1; $i < $sizeOfA; $i++) {
        $peaks[$i] = ($A[$i - 1] < $A[$i] && $A[$i] > $A[$i + 1]) ? true : false;
    }

    return $peaks;
}

function next_peaks($A)
{
    $sizeOfA = sizeof($A);
    $peaks = peaks($A);
    $next = array();
    $next[$sizeOfA - 1] = -1;
    for ($i = $sizeOfA - 2; $i >= 0; $i--) {
        $next[$i] = $peaks[$i] ? $i : $next[$i + 1];
    }

    return $next;
}

$test = new Tests('Flags');

$name = 'example';
$A = array(1, 5, 3, 4, 3, 4, 1, 2, 3, 4, 6, 2);
$result = 3;
$test->run(array($A), $result, $name);