<?php
/**
 * Created by PhpStorm.
 * User: Dayuboss
 * Date: 2019/7/29
 * Time: 21:38
 */

namespace app\util;


class Strs
{
    /**
     * 随机生成一个唯一字符串
     * */
    static public function keyGen()
    {
        return str_replace('-', '', substr(self::uuid(),1,-1));
    }

    /**
     * 生成uuid单机使用
     * @return string
     */
    static public function uuid()
    {
        $charId = md5(uniqid(mt_rand(),true));
        $hyphen = chr(45); // '-'
        $uuid = chr(123)
            .substr($charId,0,8).$hyphen
            .substr($charId,8,4).$hyphen
            .substr($charId,12,4).$hyphen
            .substr($charId,16,4).$hyphen
            .substr($charId,20,12).chr(125);

        return $uuid;
    }


}