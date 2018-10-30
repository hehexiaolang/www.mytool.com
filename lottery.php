<?php
header("content-type:text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/10/30
 * Time: 16:54
 */

$html = file_get_contents("https://m.500.com/info/kaijiang/moreexpect/ssq/?0_ala_h5baidu");

$head_arr = [];
$head_avg = 0;
$head_cnt = 0;

$tail_arr = [];
$tail_avg = 0;
$tail_cnt = 0;

if (preg_match_all("/kaij-jg-wq[\s\S]+?\/ul/", $html, $ret)) {
    foreach ($ret[0] as $item) {
        if (preg_match_all("/\d+/", $item, $num)) {
            $len = count($num[0]);
            foreach ($num[0] as $i => $v) {
                if ($i != $len - 1) {
                    $head_arr[$v] += 1;
                    $head_cnt++;
                } else {
                    $tail_arr[$v] += 1;
                    $tail_cnt++;
                }
            }
        }
    }
}

$head_avg = number_format($head_cnt / 33, 2);
$tail_avg = $tail_cnt / 16;

/** 结果显示 **/
$head_content = "红区:<br>平均次数：$head_cnt / 33 = <font color='red'>$head_avg</font><br>";

foreach ($head_arr as $key => $value) {
    if ($value >= $head_avg) {
        $head_content .= "<font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font>"
            . "<font size='2' color='red'>&nbsp;&nbsp;&nbsp;&nbsp;建议</font><br>";
    } else {
        $head_content .= "<font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font><br>";
    }
}

$tail_content = "蓝区:<br>平均次数：$tail_cnt / 16 = <font color='red'>$tail_avg</font><br>";

foreach ($tail_arr as $key => $value) {
    if ($value >= $tail_avg) {
        $tail_content .= "<font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font>"
            . "<font size='2' color='red'>&nbsp;&nbsp;&nbsp;&nbsp;建议</font><br>";
    } else {
        $tail_content .= "<font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font><br>";
    }
}
?>

<html>
<head>
    <title>彩票预测</title>
    <style type="text/css">
        .content {
            display: inline-block;
            vertical-align: top;
            margin-left: 300px;
        }
    </style>
</head>

<div>
    <div class="content"><?= $head_content ?></div>
    <div class="content"><?= $tail_content ?></div>
</div>
</html>