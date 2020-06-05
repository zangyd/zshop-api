<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    提现服务层
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/1/26
 */

namespace app\common\service;

use think\Config;

class Withdraw extends Zshop
{
    /**
     * 获取提现手续费
     * @access public
     * @return array
     */
    public function getWithdrawFee()
    {
        return ['withdraw_fee' => (float)Config::get('withdraw_fee.value', 'system_shopping')];
    }
}
