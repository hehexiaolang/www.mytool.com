<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/8/27
 * Time: 15:13
 */

require 'Block.php';

class BlockChain
{
    public $blocks = array();

    function __construct()
    {
        $this->blocks[] = new Block('', '', true);
    }

    public function addBlock($data = '')
    {
        $preHash = end($this->blocks)->hash;
        $block = new Block($data, $preHash);
        $this->blocks[] = $block;
    }
}