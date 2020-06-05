<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    订单退款控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/9/25
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class OrderRefund extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 查询一笔退款信息
            'query.refund.item' => ['queryRefundItem'],
            // 获取退款记录列表
            'get.refund.list'   => ['getRefundList'],
        ];
    }
}
