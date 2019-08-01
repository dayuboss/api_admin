<?php
/**
 * Created by PhpStorm.
 * User: Dayuboss
 * Date: 2019/7/28
 * Time: 21:25
 */

namespace app\api\controller;


use app\common\model\AdminApp;
use app\util\ReturnCode;
use app\util\Strs;

class BuildToken extends Base
{
    public function getAccessToken()
    {
        $param = $this->request->param();
        if (empty($param['app_id'])) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺失app_id');

        }
        $app_info = (new AdminApp())->where([['app_id', '=', $param['app_id']], ['app_status', '=', 1]])
            ->find();

        if (empty($app_info)) {
            return $this->buildFailed(ReturnCode::INVALID, '应用id不存在!');
        }
        if (!isset($param['signature']) || empty($param['signature'])) {
        return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'缺失签名参数');
        }

        $signature = $param['signature'];
        unset($param['signature']);
        $sign = $this->getAuthToken($app_info->app_secret, $param);

        if ($sign!== $signature) {
            return $this->buildFailed(ReturnCode::INVALID, '身份令牌验证失败!');
        }

        //获取过期时间
        $expires = config('apiAdmin.ACCESS_TOKEN_TIME_OUT');

        if (!isset($param['device_id']) || empty($param['device_id'])) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'缺失设备id:device_id参数');
        }

        //获取缓存的token
        $accessToken = cache('AccessToken:' . $param['device_id']);

        //把缓存的token设置为空
        if ($accessToken) {
            cache('AccessToken:' . $accessToken, null);
            cache('AccessToken' . $param['device_id'], null);
        }
        //创建新的token
        $accessToken = $this->buildAccessToken($app_info->app_id, $app_info->app_secret);

        $app_info->device_id = $param->device_id;

        //再缓存其token即设备的Id
        cache('AccessToken' . $accessToken, $app_info, $expires); //缓存token的位置
        cache('AccessToken' . $param['device_id'], $accessToken, $expires);//

        $result['access_token'] = $accessToken;
        $result['expires_id'] = $expires;

        return $this->buildSuccess($result);
    }

    /**
     * 构建token
     * @param $app_id
     * @param $app_secret
     * @return string
     */
    private function buildAccessToken($app_id, $app_secret)
    {
        $preStr = $app_secret . $app_id . time() . Strs::keyGen();

        return md5($preStr);
    }

    /**
     * 根据AppSecret和数据生成相对应的身份认证密钥
     * @param $app_secret
     * @param $data
     * @return string
     */
    private function getAuthToken($app_secret, $data)
    {
        if (empty($data)) {
            return '';
        } else {
            $preAre = array_merge($data, ['app_secret' => $app_secret]); //将右边的参数装到左边
            ksort($preAre); //将数组中的内容排序
            $preAre = http_build_query($preAre); //创建一个http请求

            return md5($preAre);
        }
    }
}