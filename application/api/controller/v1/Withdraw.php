<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    提现控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/21
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Withdraw extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 获取一个提现请求
            'get.withdraw.item'      => ['getWithdrawItem'],
            // 获取提现请求列表
            'get.withdraw.list'      => ['getWithdrawList'],
            // 申请一个提现请求
            'add.withdraw.item'      => ['addWithdrawItem'],
            // 取消一个提现请求
            'cancel.withdraw.item'   => ['cancelWithdrawItem'],
            // 处理一个提现请求
            'process.withdraw.item'  => ['processWithdrawItem'],
            // 完成一个提现请求
            'complete.withdraw.item' => ['completeWithdrawItem'],
            // 拒绝一个提现请求
            'refuse.withdraw.item'   => ['refuseWithdrawItem'],
            // 获取提现手续费
            'get.withdraw.fee'       => ['getWithdrawFee', 'app\common\service\Withdraw'],
        ];
    }
}
