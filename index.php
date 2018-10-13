<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/8/8
 * Time: 23:02
 */
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>我的常用工具</title>

    <style type="text/css">
        .item {
            display: inline-block;
            width: 168px;
            height: 60px;
            border: 2px solid antiquewhite;
            text-align: center;
            margin: 10px;
            line-height: 60px;
        }

        .item:hover {
            border: 2px solid yellowgreen;
        }

        .item a {
            display: block;
            width: 100%;
            height: 100%;
            text-decoration: none;
            color: gray;
        }

        .icon {
            vertical-align: middle;
            height: 30px;
        }

        .content {
            vertical-align: middle;
        }

    </style>
</head>

<body style="padding: 0;margin: 0;">
<div style="width: 80%;margin: 80px auto 0 auto;text-align: center;">
    <div>
        <div class="item">
            <a href="shuangua.php" target="_blank">
<!--                <img class="icon" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=2272523309,3903860987&fm=58">-->
                <span class="content">计算机算卦</span>
            </a>
        </div>
        <div class="item">
            <a href="https://tinypng.com/" target="_blank">
                <img class="icon" src="img/tinypng.png">
                <span class="content">TinyPNG</span></a>
        </div>
        <div class="item">
            <a href="http://tool.chinaz.com/Tools/unixtime.aspx" target="_blank">
                <img class="icon" src="img/unicode.png">
                <span class="content">Unicode/时间戳</span>
            </a>
        </div>
    </div>

    <div>
        <div class="item">
            <a href="https://cli.im/url" target="_blank">
                <img class="icon" src="img/qrcode.png">
                <span class="content">草料二维码</span>
            </a>
        </div>
        <div class="item">
            <a href="http://dwz.cn/" target="_blank">
                <img class="icon" src="img/short-url.ico">
                <span class="content">短网址生成</span>
            </a>
        </div>
        <div class="item">
            <a href="https://www.99cankao.com/colorconverter/color-coder.php" target="_blank">
                <img class="icon" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=2272523309,3903860987&fm=58">
                <span class="content">RGB转换</span>
            </a>
        </div>
    </div>
</div>


</body>
<script>
    console.log('author:fenglang');
</script>

<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?5238681cbc226bf00501d6c71176d424";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>


</html>
