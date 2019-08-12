<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2019/8/12
 * Time: 21:22
 */

$url = 'http://139.155.22.251/index.php/Home/Public/reg.html';


$phone = file_get_contents('num.txt') + 1;

$head_name_arr = array(
    '赵', '钱', '孙', '李', '周', '吴', '郑', '王',
    '冯', '陈', '储', '卫', '蒋', '沈', '韩', '杨');

$body_name_arr = array(
    '伉', '再', '冲', '刑', '向', '在', '夙', '如', '宅', '守', '字', '存', '寺', '式',
    '戌', '收', '早', '旭', '旬', '曲', '次', '此', '求', '系', '肉', '臣', '自', '舌',
    '血', '行', '圳', '西', '休', '交', '件', '企', '匠', '光', '匡', '共', '各', '考',
    '交', '件', '价', '企', '伍', '伎', '仰', '吉', '圭', '曲', '机', '艮', '六', '仲',
    '吉', '州', '朱', '兆', '决', '匠', '地', '旨', '朵', '吏', '列', '年', '劣', '同',
    '打', '汀', '至', '臼', '灯', '竹', '老', '舟', '伎', '吊', '吏', '圳', '的', '宅',
    '机', '老', '肉', '虫', '伊', '仰', '伍', '印', '因', '宇', '安', '屹', '有', '羊',
    '而', '耳', '衣', '亦', '吃', '夷', '奸', '聿', '丞', '企', '休', '任', '先', '全',
    '吉', '尖', '而', '至', '色', '伏', '后', '名', '回', '好', '妃', '帆', '灰', '牟',
    '百', '份', '米', '伐', '亥', '卉', '冰', '刑', '合', '向', '旭', '朴', '系', '行');

$nickname = $head_name_arr[array_rand($head_name_arr)]
    . $body_name_arr[array_rand($body_name_arr)]
    . $body_name_arr[array_rand($body_name_arr)];

$post_data['username'] = $phone;
$post_data['nickname'] = $nickname;
$post_data['password'] = 'f199432';
$post_data['repassword'] = 'f199432';
$post_data['invite_code'] = 19007;

$res = request_post($url, $post_data);

file_put_contents('num.txt', $phone, FILE_TEXT);
//var_dump($res);

function request_post($url = '', $post_data = array())
{
    if (empty($url) || empty($post_data)) {
        return false;
    }

    $o = "";
    foreach ($post_data as $k => $v) {
        $o .= "$k=" . urlencode($v) . "&";
    }
    $post_data = substr($o, 0, -1);

    $postUrl = $url;
    $curlPost = $post_data;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL, $postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);

    return $data;
}