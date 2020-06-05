<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    交易结算控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/20
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Transaction extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 获取一笔交易结算
            'get.transaction.item' => ['getTransactionItem'],
            // 获取交易结算列表
            'get.transaction.list' => ['getTransactionList'],
        ];
    }
}
