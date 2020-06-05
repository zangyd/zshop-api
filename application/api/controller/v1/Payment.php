<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    支付配置控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/26
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Payment extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 编辑一个支付配置
            'set.payment.item'    => ['setPaymentItem'],
            // 获取一个支付配置
            'get.payment.item'    => ['getPaymentItem'],
            // 获取支付配置列表
            'get.payment.list'    => ['getPaymentList'],
            // 获取支付异步URL接口
            'get.payment.notify'  => ['getPaymentNotify', 'app\common\service\Payment'],
            // 获取支付同步URL接口
            'get.payment.return'  => ['getPaymentReturn', 'app\common\service\Payment'],
            // 设置支付配置排序
            'set.payment.sort'    => ['setPaymentSort'],
            // 根据编号自动排序
            'set.payment.index'   => ['setPaymentIndex'],
            // 批量设置支付配置状态
            'set.payment.status'  => ['setPaymentStatus'],
            // 财务对账号进行资金调整
            'set.payment.finance' => ['setPaymentFinance'],
            // 接收支付返回内容
            'put.payment.data'    => ['putPaymentData'],
            // 账号在线充值余额
            'user.payment.pay'    => ['userPaymentPay'],
            // 订单付款在线支付
            'order.payment.pay'   => ['orderPaymentPay'],
        ];
    }
}
