<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


Route::get('hello/:name', 'index/hello');

Route::get('api/index/:id$', 'index/index', [
    'before' => [
        'app\\api\\behavior\\Permission',
        'app\\api\\behavior\\Auth'
    ]
]);

Route::post('api/gettoken','BuildToken/getAccessToken');

return [

];
