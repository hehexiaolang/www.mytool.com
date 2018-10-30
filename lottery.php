<?php
header("content-type:text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/10/30
 * Time: 16:54
 */

$total_num = $_GET['total_num'] ? $_GET['total_num'] : 1;

$head_arr = [];
$head_cnt = 0;

$tail_arr = [];
$tail_cnt = 0;

for ($i = 1; $i <= $total_num; $i++) {
    $html = file_get_contents("http://www.17500.cn/widget/_ssq/ssqfanjiang/p/$i.html");

    if (preg_match_all("/\d\d\s\d\d\s\d\d\s\d\d\s\d\d\s\d\d\+\d\d/", $html, $ret)) {
        foreach ($ret[0] as $item) {
            if (preg_match_all("/\d+/", $item, $num)) {
                $len = count($num[0]);
                foreach ($num[0] as $k => $v) {
                    if ($k != $len - 1) {
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
}

$head_max = max($head_arr);
$head_avg = number_format($head_cnt / 33, 2);

$tail_max = max($tail_arr);
$tail_avg = $tail_cnt / 16;

/** 结果显示 **/
$head_content = "红区:<br>平均次数：$head_cnt / 33 = <font color='green'>$head_avg</font>";

foreach ($head_arr as $key => $value) {
    if ($value >= $head_avg) {
        $head_content .= "<br><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font>"
            . "<font size='2' color='green'>&nbsp;&nbsp;&nbsp;&nbsp;建议</font>";

        if ($value == $head_max) {
            $head_content .= "<font size='2' color='red'>&nbsp;&nbsp;&nbsp;&nbsp;最多</font>";
        }
    } else {
        $head_content .= "<br><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font>";
    }
}

$tail_content = "蓝区:<br>平均次数：$tail_cnt / 16 = <font color='green'>$tail_avg</font>";

foreach ($tail_arr as $key => $value) {
    if ($value >= $tail_avg) {
        $tail_content .= "<br><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font>"
            . "<font size='2' color='green'>&nbsp;&nbsp;&nbsp;&nbsp;建议</font>";

        if ($value == $tail_max) {
            $tail_content .= "<font size='2' color='red'>&nbsp;&nbsp;&nbsp;&nbsp;最多</font>";
        }
    } else {
        $tail_content .= "<br><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;[$key] => $value</font>";
    }
}
?>

<html>
<head>
    <title>双色球概率分析</title>
    <style type="text/css">
        .content {
            display: inline-block;
            vertical-align: top;
            margin-left: 150px;
        }
    </style>
</head>
<div>
    <div class="content"><?= $head_content ?></div>
    <div class="content"><?= $tail_content ?></div>
</div>

<form action="lottery.php" method="get">
    <select title="条数" name="total_num" style="width: 100px;height: 50px;">
        <?php
        for ($i = 1; $i <= 11; $i++) {
            if ($total_num == $i) {
                echo "<option selected='selected' value='$i'>{$i}00条</option>";
            } else {
                echo "<option value='$i'>{$i}00条</option>";
            }
        }
        ?>
    </select>
    <input style="width: 100px;height: 50px;-webkit-appearance:button;" type="submit" value="提交"/>
</form>
</html>