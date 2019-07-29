<?php
/**
 * Created by PhpStorm.
 * User: Dayuboss
 * Date: 2019/7/28
 * Time: 20:31
 */

namespace app\util;


class ReturnCode
{

    const SUCCESS = 1; //成功
    const INVALID = -1; //无效请求,默认的异常代码

    const DN_READ_ERROR = -3; //数据库获取异常
    const DN_SAVE_ERROR = -2;//数据库保存异常

    const PARAM_INVALID = -995; //http参数无效
    const EMPTY_PARAMS = -12;//缺失参数

    const DELETE_FAILED = -20; //删除失败
    const ADD_FAILED = -21;//添加失败
    const UPDATE_FAILED = -22;//更新失败

    const EXCEPTION = -999; //服务器发生异常
}