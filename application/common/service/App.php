<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    应用管理服务层
 *
 * @author      zachary <zangyd@163.com>
 * @date        2020/2/28
 */

namespace app\common\service;

use captcha\Captcha;
use think\Url;
use think\Request;

class App extends Zshop
{
    /**
     * 获取应用验证码调用地址
     * @access public
     * @return mixed
     */
    public function getCaptchaCallurl()
    {
        $vars = ['method' => 'image.app.captcha'];
        $data['call_url'] = Url::bUild('/api/v1/app', $vars, true, true);

        return $data;
    }

    /**
     * 获取应用验证码
     * @access public
     * @return mixed
     */
    public function imageAppCaptcha()
    {
        $config = [
            'length'   => 4,
            'useCurve' => false,
            'fontttf'  => '1.ttf',
            'codeSet'  => '02345689',
            'bg'       => [255, 255, 255],
        ];

        $request = Request::instance();
        $id = $request->param('session_id');
        $generate = $request->param('generate');

        $captcha = new Captcha($config);
        $image = $captcha->getImage($id);

        if ($generate == 'base64') {
            return [
                'content_type' => 'image/png',
                'base64'       => base64_encode($image),
            ];
        } else {
            $result = response($image, 200, ['Content-Length' => strlen($image)])
                ->contentType('image/png');

            return [
                'callback_return_type' => 'response',
                'is_callback'          => $result,
            ];
        }
    }

    /**
     * 验证应用验证码
     * @access public
     * @param string $code 验证码
     * @return bool
     */
    public static function checkCaptcha($code)
    {
        $captcha = new Captcha();
        $id = Request::instance()->param('session_id');

        $result = $captcha->check($code, $id);
        return $result === false ? $captcha->getError() : true;
    }
}
