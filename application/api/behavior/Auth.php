<?php
/**
 * Created by PhpStorm.
 * User: Dayuboss
 * Date: 2019/7/31
 * Time: 22:36
 */

namespace app\api\behavior;


use app\util\ReturnCode;
use think\exception\HttpResponseException;
use think\Request;
use think\Response;
use traits\controller\Jump;

class Auth
{
    use Jump;
    public function run(Request $request)
    {
        list($code,$msg) = $this->checkAccessToken($request);
        if ($code && $msg) {
        return $this->result([],$code,$msg,'json');
        }
    }

    private function checkAccessToken($request)
    {
        $access_token = $request->header('access-token');
        if (!isset($access_token) || !$access_token) {
            return [ ReturnCode::EMPTY_PARAMS,  '缺失参数access-token', []];

        } else {
            $app_info = cache('AccessToken:' . $access_token);
            if (!$app_info) {
                return [ReturnCode::ACCESS_TOKEN_TIMEOUT,  'access-token已过期',  []];
            }
        }
    }
}