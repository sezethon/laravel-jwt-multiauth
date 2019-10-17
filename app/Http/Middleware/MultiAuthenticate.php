<?php

namespace App\Http\Middleware;

use Log;
use Closure;

class MultiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $identity
     * @return mixed
     */
    public function handle($request, Closure $next, $identity)
    {
        try {
            if (!$request->header('Authorization')) {
                return response()
                    ->json(['retcode' => '100003', 'retmsg' => '您没有登录'], 401);
            }

            if ($identity != auth()->guard($identity)->payload()->get('identity')) {
                return response()
                    ->json(['retcode' => '100005', 'retmsg' => '登录身份错误'], 401);
            }

            if(!auth()->guard($identity)->userOrFail()) {
                return response()
                    ->json(['retcode' => '100004', 'retmsg' => '登录异常'], 401);
            }

            return $next($request);
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            try {
                $token = auth()->guard($identity)->refresh();

                // auth()->guard($identity)->onceUsingId(auth()->guard($identity)->payload()->get('sub'));
            }
            catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()
                    ->json(['retcode' => '100002', 'retmsg' => '登录状态已失效'], 401);
            }

            $request->headers->set('Authorization', 'Bearer '.$token);

            return $next($request)->header('Authorization', 'Bearer '.$token);
        }
        catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            $identity_name = ($identity=='teacher') ? '教师' : '学生';

            return response()
                ->json(['retcode' => '100001', 'retmsg' => $identity_name.'证号或密码错误'], 401);
        }
        catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()
                ->json(['retcode' => '999998', 'retmsg' => '登录状态异常'], 401);
        }

        return response()
                ->json(['retcode' => '999999', 'retmsg' => '系统异常'], 401);
    }
}
