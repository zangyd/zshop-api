<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    账号资金控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/22
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class UserMoney extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 获取指定账号资金信息
            'get.user.money.info' => ['getUserMoneyInfo'],
        ];
    }
}
