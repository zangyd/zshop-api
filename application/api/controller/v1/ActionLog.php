<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    操作日志控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/10/24
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class ActionLog extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 获取一条操作日志
            'get.action.log.item' => ['getActionLogItem'],
            // 获取操作日志列表
            'get.action.log.list' => ['getActionLogList'],
        ];
    }
}
