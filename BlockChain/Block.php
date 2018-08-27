<?php
/**
 * Created by PhpStorm.
 * User: fenglang
 * Date: 2018/8/27
 * Time: 14:05
 */


class Block
{
    const BITES = 6; // 前置0位数

    public $version;
    public $preBlockHash;
    public $hash;
    public $nonce;
    public $timestamp;


    public $data;

    function __construct($data = '', $preBlockHash = '', $isGenesisBlock = false)
    {
        $this->version = 1;
        $this->preBlockHash = $isGenesisBlock ? '' : $preBlockHash;
        $this->nonce = 0;
        $this->data = $isGenesisBlock ? "This is Genesis block" : $data;
        $this->timestamp = time();
        $this->run();
    }

    function run()
    {
        $nonce = 0;
        $preZeroStr = str_pad("", self::BITES, "0");

        echo "run starting\n";

        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $nonceHash = md5($this->getNonceStr($nonce));

            if (substr($nonceHash, 0, self::BITES) === $preZeroStr) {
                $this->hash = $nonceHash;
                $this->nonce = $nonce;
                break;
            } else {
                $nonce++;
            }
        }

        echo "run data:{$this->data}, preHash:{$this->preBlockHash}, hash:{$this->hash}, nonce:{$this->nonce}\n";
    }

    function getNonceStr($nonce = '')
    {
        return $this->version . $this->preBlockHash . $nonce . $this->data. $this->timestamp;
    }

}