<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2019/3/26
 * Time: 19:14
 */


$data = [7, 3, 5, 1, 9, 11];


//$new_data = bubbleSort($data);
//print_r($new_data);

quickSort($data, 0, count($data) - 1);
print_r($data);


function quickSort(&$arr = array(), $left, $right)
{
    if ($left >= $right) {
        return;
    }

    $i = $left;
    $j = $right;
    $key = $arr[$left];

    while ($i < $j) {
        while ($i < $j && $arr[$j] >= $key) {
            $j--;
        }
        $arr[$i] = $arr[$j];

        while ($i < $j && $arr[$i] <= $key) {
            $i++;
        }
        $arr[$j] = $arr[$i];
    }

    $arr[$i] = $key;

    quickSort($arr, $left, $i - 1);
    quickSort($arr, $i + 1, $right);
}


function bubbleSort($arr = array())
{
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j < count($arr); $j++) {
            if ($arr[$j] > $arr[$i]) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }
    return $arr;
}