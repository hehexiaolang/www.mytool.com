<?php

$m = (int)$_GET['m'];
if (!is_int($m)) {
    echo "请输入明文！:".$m;
    return;
}

$p = 5;
$q = 7;
$e = 11;

$n = $p * $q;
$f_n = ($p - 1) * ($q - 1);
$d = getD($e, $f_n);
// (e,n)为公钥 (d,n)为私钥, 当然也可对调

$c = pow($m, $e) % $n;
echo "$m ^ $e mod $n = $c";

$m = pow($c, $d) % $n;
echo "<br>$c ^ $d mod $n = $m";

function getD($e, $t)
{
    $d = 1;
    while ((($e * $d) % $t) != 1) {
//        $tmp = ($e * $d) % $t;
//        echo "$e * $d mod $t = $tmp<br>";
        $d++;
    }
    echo "$e * $d mod $t = 1<br>";
    return $d;
}