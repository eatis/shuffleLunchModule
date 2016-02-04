<?php
function opensslRand($min = 0, $max = PHP_INT_MAX) {
    $min = (int)$min;
    $max = (int)$max;
    $range = $max - $min;
    if ($range <= 0) {
        return $min;
    }
    $log = log($range, 2);
    $bytes = (int)($log / 8) + 1;
    $filter = (int)(1 << $bites) - 1;
    do {
        $rand = hexdec(bin2hex(openssl_random_bytes($bytes))) & $filter;
    } while ($rand > $range);
    return $min + $rand;
}

function opensslArrayRand(array $array, $num = 1) {
    $num = (int)$num;
    $count = count($array);
    if ($num <= 0 || $count < $num) {
        return null;
    }
    foreach ($array as $key => $_) {
        if (!$num) {
            break;
        }
        if (opensslRand() / (PHP_INT_MAX + 1) < $num / $count) {
            $retval[] = $key;
            --$num;
        }
        --$count;
    }
    return !isset($retval[1]) ? $retval[0] : $retval;
}


function opensslShuffle(array &$array) {
    $array = array_values($array);
    var_dump($array);
    for ($i = count($array) - 1; $i > 0; --$i) {
        $j = opensslRand(0, $i);
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }
}


$shuffleName = ['name1' => 1, 'name2' => 2, 'name3' => 3, 'name4' => 4, 'name5' => 5, 'name6' => 6];
opensslShuffle($suffleName);
var_dump($suffleName);
