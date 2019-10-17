<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    // 教师登录接口
    public function login(Request $request)
    {
        Log::info(__METHOD__." Method Started");

        $credentials = $request->only('teacher_card_id', 'password');

        if (!$token = auth()->guard('teacher')->attempt($credentials)) {
            return response()
                ->json(['retcode' => '100001', 'retmsg' => '教师证号或密码错误'], 401);
        }

        return response()
            ->json(['retcode' => '000000', 'retmsg' => '登录成功'], 200)
            ->header('Authorization', 'Bearer '.$token); // 响应头添加token
    }

    // 教师信息展示接口
    public function me(Request $request)
    {
        Log::info(__METHOD__." Method Started");

        if (!$me = auth()->guard('teacher')->user()) {
            return response()
                ->json(['retcode' => '100004', 'retmsg' => '登录异常'], 401);
        }

        return response()
            ->json(['retcode' => '000000', 'retmsg' => '请求成功',
                'me' => array($me),
            ], 200);
    }
}
