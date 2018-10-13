<?php
header("content-type:text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/10/11
 * Time: 16:24
 *
 * 乾三连，坤六断。
 * 震仰盂，艮覆碗。
 * 离中虚，坎中断。
 * 兑上缺，巽下断。
 */

$total = 49;
$four = 4;

gua();

function gua()
{
    $yiao_arr = [];

    for ($i = 0; $i < 6; $i++) {
        $yiao_arr[] = yiao();
    }

    $yiao_arr = array_reverse($yiao_arr);

    echo "<br>***本卦**********变卦<br>";

    $gua_name1 = get_gua_name($yiao_arr[0], $yiao_arr[1], $yiao_arr[2]);
    $gua_name2 = get_gua_name($yiao_arr[3], $yiao_arr[4], $yiao_arr[5]);

    echo "***$gua_name1***<br>";
    echo "***$gua_name2***<br>";

    foreach ($yiao_arr as $k => $v) {
        switch ($v) {
            case 6:
                echo "—— ——&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;————&nbsp;&nbsp;变<br>";
                break;
            case 7:
                echo "————&nbsp;&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;————<br>";
                break;
            case 8:
                echo "—— ——&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;—— ——<br>";
                break;
            case 9:
                echo "————&nbsp;&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;—— ——&nbsp;变<br>";
                break;
            default:
                echo "出错了";
        }
    }
}

function yiao()
{
    global $total, $four;

    $ret = bian(bian(bian($total)));
    $ret = $ret / $four;

    echo "爻：$ret<br>";
    return $ret;
}

function bian($total)
{
    $sky = rand(1, $total - 2);
    $earth = $total - $sky - 1;
    $people = 1;

    $sky_mod = mod($sky);
    $earth_mode = mod($earth);

    echo "total:$total , 天：$sky:$sky_mod , 地：$earth:$earth_mode , 人：$people<br>";

    return $sky_mod + $earth_mode;
}

function get_gua_name($one, $two, $three)
{
    $yin = 2;
    $yang = 3;

    $gua_name_arr = array(
        333 => "乾",
        222 => "坤",
        223 => "震",
        322 => "艮",
        323 => "离",
        232 => "坎",
        233 => "兑",
        332 => "巽"
    );

    $one = $one % 2 == 0 ? $yin : $yang;
    $two = $two % 2 == 0 ? $yin : $yang;
    $three = $three % 2 == 0 ? $yin : $yang;

    return $gua_name_arr[$one . $two . $three];
}

function mod($num)
{
    global $four;
    $mod = $num % $four;

    if ($mod == 0) {
        $mod = $four;
    }
    return $num - $mod;
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>计算机算卦</title>
</head>

<body>
<!--<input type="button" value="开始算命">-->
</body>
</html>
