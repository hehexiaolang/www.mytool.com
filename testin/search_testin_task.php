<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2019/5/10
 * Time: 19:26
 */

// 引入PHPMailer的核心文件
require_once("../tool/PHPMailer-6.0.7/src/PHPMailer.php");
require_once("../tool/PHPMailer-6.0.7/src/SMTP.php");

// QQ邮箱（1004859057@qq.com）授权码：twtzkumxxrapbcdf

ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行

$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$is_continue = include('config.php');
$time = 5;

if (!$is_continue) {
    return;
}

$html = file_get_contents('https://www.ztestin.com/hall');

$cnt = preg_match_all('/clearboth[\w\W]*?h_task_status/', $html, $res);
if ($cnt <= 0) {
    return;
}

$mail_body = "";
$has_new_item = false;
$last_item = 'last_item.txt';
$last_item_title = file_get_contents($last_item);

foreach ($res[0] as $key => $item) {
    if ($key > 4) break;

    preg_match('/hall\/info[\w\W]+?\"/', $item, $item_url);
    preg_match('/<span>[\w\W]+?<\/span>/', $item, $title);
    preg_match('/(\d+天)?\d+?小时/', $item, $time);
    preg_match('/报名详情[\w\W]+\d+\/\d+/', $item, $rate_item);
    preg_match('/\d+\/\d+/', $rate_item[0], $rate);

    if ($key == 0 && $last_item_title != $title[0]) { // 新项目产生,则发邮件
        $has_new_item = true;
        file_put_contents($last_item, $title[0], FILE_TEXT); // 将最新项目写入文件
    }

    if (!$time) {
        $time[0] = "已过期";
    }
    $item_url = 'https://www.ztestin.com/' . rtrim($item_url[0], "\"");
    $mail_body .= "<a style='color: #1081DE;text-decoration:none;' href='$item_url'>标题：{$title[0]}</a></br>" . "报名详情：{$rate[0]}&nbsp;&nbsp;&nbsp;&nbsp;" . "剩余时间：{$time[0]}<br><br>";
}

/**
 * 发送邮件配置参数
 */

$mail = new \PHPMailer\PHPMailer\PHPMailer(); // 实例化PHPMailer核心类
//$mail->SMTPDebug = 1; // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
$mail->isSMTP(); // 使用smtp鉴权方式发送邮件
$mail->SMTPAuth = true; // smtp需要鉴权 这个必须是true
$mail->Host = 'smtp.qq.com';// 链接qq域名邮箱的服务器地址
$mail->SMTPSecure = 'ssl';// 设置使用ssl加密方式登录鉴权
$mail->Port = 465;// 设置ssl连接smtp服务器的远程服务器端口号
$mail->CharSet = 'UTF-8';// 设置发送的邮件的编码

$mail->FromName = 'Testin新项目';// 发件人昵称
$mail->Username = '1004859057@qq.com';// smtp登录的账号 QQ邮箱即可
$mail->Password = 'twtzkumxxrapbcdf';// smtp登录的密码 使用生成的授权码
$mail->From = '1004859057@qq.com';// 发件人邮箱地址 同登录账号
$mail->isHTML(true);// 邮件正文是否为html编码 注意此处是一个方法
$mail->addAddress('1340797683@qq.com');// 收件人邮箱 注：添加多个收件人 则多次调用方法即可
$mail->Subject = 'Testin有新项目啦';// 邮件主题
$mail->Body = $mail_body;// 邮件正文
//$mail->addAttachment('./example.pdf');// 为该邮件添加附件

if ($has_new_item) {
    $success = $mail->send();// 发送邮件 返回状态
}

sleep(15);
file_get_contents($url);
//echo "发送成功: " . time();



