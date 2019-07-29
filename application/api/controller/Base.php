<?php
/**
 * Created by PhpStorm.
 * User: Dayuboss
 * Date: 2019/7/28
 * Time: 20:12
 */

namespace app\api\controller;


use app\util\ReturnCode;
use think\Controller;

class Base extends Controller
{
    /**
     * 统一的接口的成功返回的处理方式
     * @param array $data 返回的数据
     * @param string $msg 返回的信息
     * @param int $code 返回的状态码
     * @return \think\response\Json
     */
    protected function buildSuccess($data = [], $msg = "操作成功", $code = ReturnCode::SUCCESS)
    {
      return  $this->buildReturn($code,$msg,$data);
    }

    /**
     * 统一的接口的异常返回的处理方式
     * @param string $msg
     * @param int $code
     * @param array $data
     * @return array
     */
    protected function buildFailed( $code,$msg = "failed", $data = [])
    {
     return   $this->buildReturn($code,$msg,$data);
    }

    /**
     * 统一的接口数据返回处理
     * @param $code
     * @param $msg
     * @param $data
     * @return \think\response\Json
     */
    private function buildReturn($code,$msg,$data)
    {

        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return json($result);
    }
}