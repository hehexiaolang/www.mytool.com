<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/8/24
 * Time: 11:28
 */

require 'BlockChain/BlockChain.php';


$blockChain = new BlockChain();

$blockChain->addBlock('A to B 3 BTC');
$blockChain->addBlock('B to C 4 BTC');


foreach ($blockChain->blocks as $block) {
    echo "\n" . json_encode($block);
}






