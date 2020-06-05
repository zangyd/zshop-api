<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    验证码控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/7/20
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Verification extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 使用验证码
            'use.verification.item'   => ['useVerificationItem'],
            // 发送短信验证码
            'send.verification.sms'   => ['sendVerificationSms'],
            // 发送邮件验证码
            'send.verification.email' => ['sendVerificationEmail'],
            // 验证短信验证码
            'ver.verification.sms'    => ['verVerificationSms'],
            // 验证邮件验证码
            'ver.verification.email'  => ['verVerificationEmail'],
        ];
    }
}
