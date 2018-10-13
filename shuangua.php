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

$left_content = "";
$center_content = "";
$right_content = "";

gua();

function gua()
{
    global $center_content;
    $yao_arr = [];

    for ($i = 0; $i < 6; $i++) {
        $yao_arr[] = yao();
    }

    $yao_arr = array_reverse($yao_arr);

    get_detail($yao_arr);

    $center_content .= "***本卦**********变卦<br>";

    $gua_name1 = get_gua_name($yao_arr[0], $yao_arr[1], $yao_arr[2]);
    $gua_name2 = get_gua_name($yao_arr[3], $yao_arr[4], $yao_arr[5]);

    $center_content .= "***$gua_name1***<br>";
    $center_content .= "***$gua_name2***<br>";

    foreach ($yao_arr as $k => $v) {
        switch ($v) {
            case 6:
                $center_content .= "—— ——&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;————&nbsp;&nbsp;变<br>";
                break;
            case 7:
                $center_content .= "————&nbsp;&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;————<br>";
                break;
            case 8:
                $center_content .= "—— ——&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;—— ——<br>";
                break;
            case 9:
                $center_content .= "————&nbsp;&nbsp;$v&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;—— ——&nbsp;变<br>";
                break;
            default:
                $center_content .= "出错了";
        }
    }
}

function yao()
{
    global $total, $four, $left_content;

    $ret = bian(bian(bian($total)));
    $ret = $ret / $four;

    $left_content .= "爻：$ret<br>";
    return $ret;
}

function bian($total)
{
    global $left_content;
    $sky = rand(1, $total - 2);
    $earth = $total - $sky - 1;
    $people = 1;

    $sky_mod = mod($sky);
    $earth_mode = mod($earth);

    $left_content .= "total:$total , 天：$sky:$sky_mod , 地：$earth:$earth_mode , 人：$people<br>";

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

// 获取卦辞和爻辞
function get_detail($yao_arr)
{
    global $right_content;

    $page_num = get_detail_url($yao_arr);
    $url = "https://so.gushiwen.org/guwen/bookv_$page_num.aspx";
    $html = file_get_contents($url);
    $title = [];
    $content = [];

    if (preg_match("/<b>[\s\S]+?<\/b>/", $html, $title)) { // 卦名
        $right_content .= "<h2>{$title[0]}</h2>";
    }

    if (preg_match("/<div class=\"contson[\s\S]+?div>/", $html, $content)) { // 卦辞、爻辞
        $right_content .= $content[0];
    } else {
        $right_content .= "没有匹配";
    }
}

function get_detail_url($yao_arr)
{
    $yin = 2;
    $yang = 3;

    $arr = array(
        333 => array( // "乾"
            333 => 218, // "乾",乾
            222 => 229, // "坤",否
            223 => 242, // "震",无妄
            322 => 250, // "艮",遯、遁
            323 => 230, // "离",同人
            232 => 223, // "坎",讼
            233 => 227, // "兑",履
            332 => 261, // "巽",姤
        ),
        222 => array( // "坤"
            333 => 228, // "乾",泰
            222 => 219, // "坤",坤
            223 => 241, // "震",复
            322 => 232, // "艮",谦
            323 => 253, // "离",明夷
            232 => 224, // "坎",师
            233 => 236, // "兑",临
            332 => 263, // "巽",升
        ),
        223 => array( // "震"
            333 => 251, // "乾",大壮
            222 => 233, // "坤",豫
            223 => 268, // "震",震
            322 => 279, // "艮",小过
            323 => 272, // "离",丰
            232 => 257, // "坎",解
            233 => 271, // "兑",归妹
            332 => 249, // "巽",恒
        ),
        322 => array( // "艮"
            333 => 243, // "乾",大畜
            222 => 240, // "坤",剥
            223 => 244, // "震",颐
            322 => 269, // "艮",艮
            323 => 239, // "离",贲
            232 => 221, // "坎",蒙
            233 => 258, // "兑",损
            332 => 235, // "巽",蛊
        ),
        323 => array( // "离"
            333 => 231, // "乾",大有
            222 => 252, // "坤",晋
            223 => 238, // "震",噬嗑
            322 => 273, // "艮",旅
            323 => 247, // "离",离
            232 => 281, // "坎",未济
            233 => 255, // "兑",睽
            332 => 267, // "巽",鼎
        ),
        232 => array( // "坎"
            333 => 222, // "乾",需
            222 => 225, // "坤",比
            223 => 220, // "震",屯
            322 => 256, // "艮",蹇
            323 => 280, // "离",既济
            232 => 246, // "坎",坎
            233 => 277, // "兑",节
            332 => 265, // "巽",井
        ),
        233 => array( // "兑"
            333 => 260, // "乾",夬
            222 => 262, // "坤",萃
            223 => 234, // "震",随
            322 => 248, // "艮",咸
            323 => 266, // "离",革
            232 => 264, // "坎",困
            233 => 275, // "兑",兑
            332 => 245, // "巽",大过
        ),
        332 => array( // "巽"
            333 => 226, // "乾",小畜
            222 => 237, // "坤",观
            223 => 259, // "震",益
            322 => 270, // "艮",渐
            323 => 254, // "离",家人
            232 => 275, // "坎",涣
            233 => 278, // "兑",中孚
            332 => 274, // "巽",巽
        )
    );

    foreach ($yao_arr as $k => $v) {
        $yao_arr[$k] = $v % 2 == 0 ? $yin : $yang;
    }

    $up = $yao_arr[0] . $yao_arr[1] . $yao_arr[2]; // 上三爻
    $down = $yao_arr[3] . $yao_arr[4] . $yao_arr[5]; // 下三爻

    return $arr[$up][$down];
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>计算机算卦</title>
</head>

<body>

<style type="text/css">
    .frame {
        display: inline-block;
        vertical-align: top;
    }
</style>
<div>
    <div class="frame">
        <?= $left_content ?>
    </div>
    <div class="frame" style="margin: 150px auto auto 200px;">
        <?= $center_content ?>
    </div>
    <div class="frame" style="margin: 90px auto auto 200px;width: 400px">
        <?= $right_content ?>
    </div>
</div>
</body>
</html>
