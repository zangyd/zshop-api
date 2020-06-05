<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    支付日志控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/28
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class PaymentLog extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 关闭一笔充值记录
            'close.payment.log.item' => ['closePaymentLogItem'],
            // 获取一笔充值记录
            'get.payment.log.item'   => ['getPaymentLogItem'],
            // 获取充值记录列表
            'get.payment.log.list'   => ['getPaymentLogList'],
        ];
    }
}
