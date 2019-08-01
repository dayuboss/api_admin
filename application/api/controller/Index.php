<?php

namespace app\api\controller;

use app\util\ReturnCode;

class Index extends Base
{
    public function index()
    {
        $id = $this->request->param('id');
        if (!$id) {
            return $this->buildFailed('id参数为空',ReturnCode::PARAM_INVALID);

        } else {
            $data = $this->app->model('admin_app')->find($id);
            return $this->buildSuccess($data);
        }

    }

    public function add()
    {
        return $this->buildSuccess();
    }
}
