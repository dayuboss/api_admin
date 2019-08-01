<?php
/**
 * Created by PhpStorm.
 * User: Dayuboss
 * Date: 2019/7/31
 * Time: 22:08
 */

namespace app\api\behavior;


use app\util\ReturnCode;
use think\Request;

class Permission
{
    /**
     * 接口的授权
     * @param Request $request
     * @param $param
     * @return \think\response\Json
     */
    public function run(Request $request,$param)
    {
//      $hash = $request->routeInfo();
//
//      //TODO:跨域
//
//        $access_token = $request->header('apiAuth','');
//        if ($access_token){
//            $app_info = cache('AccessToken:'.$access_token);
//            $allRules = explode(',',$app_info['app_ap']);
//            if (!in_array($hash,$allRules)){
//                return json(['code'=>ReturnCode::INVALID,'msg'=>'你没有权限这么做','data'=>[]])
//                    ->code(200);
//            }
//        }

    }
}